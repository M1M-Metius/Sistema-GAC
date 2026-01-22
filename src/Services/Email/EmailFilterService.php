<?php
/**
 * GAC - Servicio de Filtrado de Emails
 * 
 * Filtra emails por asunto usando patrones configurados en settings
 * 
 * @package Gac\Services\Email
 */

namespace Gac\Services\Email;

use Gac\Repositories\SettingsRepository;

class EmailFilterService
{
    /**
     * Repositorio de settings
     */
    private SettingsRepository $settingsRepository;

    /**
     * Cache de patrones de asuntos por plataforma
     */
    private array $subjectPatternsCache = [];

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->settingsRepository = new SettingsRepository();
        $this->loadSubjectPatterns();
    }

    /**
     * Cargar patrones de asuntos desde settings
     */
    private function loadSubjectPatterns(): void
    {
        $allSubjects = $this->settingsRepository->getAllEmailSubjects();
        
        foreach ($allSubjects as $platform => $subjects) {
            // Verificar que la plataforma esté habilitada
            if (!$this->settingsRepository->isPlatformEnabled($platform)) {
                continue;
            }
            
            $this->subjectPatternsCache[$platform] = $subjects;
        }
    }

    /**
     * Filtrar emails por asunto
     * 
     * @param array $emails Array de emails
     * @return array Array de emails filtrados con información de plataforma
     */
    public function filterBySubject(array $emails): array
    {
        $filtered = [];
        
        foreach ($emails as $email) {
            $subject = $email['subject'] ?? '';
            
            if (empty($subject)) {
                continue;
            }
            
            // Intentar identificar plataforma y verificar si coincide con algún asunto
            $platform = $this->matchSubjectToPlatform($subject);
            
            if ($platform !== null) {
                $email['matched_platform'] = $platform;
                $email['matched_subject'] = $this->findMatchingSubject($subject, $platform);
                $filtered[] = $email;
            }
        }
        
        return $filtered;
    }

    /**
     * Verificar si un email coincide con algún asunto de una plataforma específica
     * 
     * @param array $email Datos del email
     * @param string $platform Slug de la plataforma
     * @return bool
     */
    public function matchesPlatform(array $email, string $platform): bool
    {
        $subject = $email['subject'] ?? '';
        
        if (empty($subject)) {
            return false;
        }
        
        if (!isset($this->subjectPatternsCache[$platform])) {
            return false;
        }
        
        $subjects = $this->subjectPatternsCache[$platform];
        
        return $this->matchesAnySubject($subject, $subjects);
    }

    /**
     * Identificar plataforma desde asunto
     * 
     * @param string $subject
     * @return string|null Slug de la plataforma o null
     */
    public function matchSubjectToPlatform(string $subject): ?string
    {
        foreach ($this->subjectPatternsCache as $platform => $subjects) {
            if ($this->matchesAnySubject($subject, $subjects)) {
                return $platform;
            }
        }
        
        return null;
    }

    /**
     * Encontrar el asunto que coincide
     * 
     * @param string $subject
     * @param string $platform
     * @return string|null
     */
    public function findMatchingSubject(string $subject, string $platform): ?string
    {
        if (!isset($this->subjectPatternsCache[$platform])) {
            return null;
        }
        
        $subjects = $this->subjectPatternsCache[$platform];
        
        foreach ($subjects as $pattern) {
            if ($this->matchesSubject($subject, $pattern)) {
                return $pattern;
            }
        }
        
        return null;
    }

    /**
     * Verificar si un asunto coincide con alguno de los patrones
     * 
     * @param string $subject
     * @param array $patterns
     * @return bool
     */
    private function matchesAnySubject(string $subject, array $patterns): bool
    {
        foreach ($patterns as $pattern) {
            if ($this->matchesSubject($subject, $pattern)) {
                return true;
            }
        }
        
        return false;
    }

    /**
     * Verificar si un asunto coincide con un patrón específico
     * 
     * @param string $subject
     * @param string $pattern
     * @return bool
     */
    private function matchesSubject(string $subject, string $pattern): bool
    {
        // Normalizar ambos strings
        $subject = mb_strtolower(trim($subject), 'UTF-8');
        $pattern = mb_strtolower(trim($pattern), 'UTF-8');
        
        // Comparación exacta
        if ($subject === $pattern) {
            return true;
        }
        
        // Comparación con contains (el patrón está contenido en el asunto)
        if (strpos($subject, $pattern) !== false) {
            return true;
        }
        
        // Comparación con contains inverso (el asunto está contenido en el patrón)
        if (strpos($pattern, $subject) !== false) {
            return true;
        }
        
        // Comparación con similitud (para casos con variaciones menores)
        $similarity = $this->calculateSimilarity($subject, $pattern);
        
        // Si la similitud es mayor al 80%, considerarlo coincidencia
        if ($similarity >= 0.8) {
            return true;
        }
        
        return false;
    }

    /**
     * Calcular similitud entre dos strings (Jaro-Winkler simplificado)
     * 
     * @param string $str1
     * @param string $str2
     * @return float Similitud entre 0 y 1
     */
    private function calculateSimilarity(string $str1, string $str2): float
    {
        // Si son iguales, similitud 1.0
        if ($str1 === $str2) {
            return 1.0;
        }
        
        // Si uno está vacío, similitud 0.0
        if (empty($str1) || empty($str2)) {
            return 0.0;
        }
        
        // Calcular distancia de Levenshtein
        $maxLen = max(strlen($str1), strlen($str2));
        $distance = levenshtein($str1, $str2);
        
        // Convertir distancia a similitud
        $similarity = 1 - ($distance / $maxLen);
        
        return max(0.0, min(1.0, $similarity));
    }

    /**
     * Filtrar emails por plataforma específica
     * 
     * @param array $emails
     * @param string $platform
     * @return array
     */
    public function filterByPlatform(array $emails, string $platform): array
    {
        $filtered = [];
        
        foreach ($emails as $email) {
            if ($this->matchesPlatform($email, $platform)) {
                $email['matched_platform'] = $platform;
                $email['matched_subject'] = $this->findMatchingSubject($email['subject'] ?? '', $platform);
                $filtered[] = $email;
            }
        }
        
        return $filtered;
    }

    /**
     * Obtener estadísticas de filtrado
     * 
     * @param array $emails
     * @return array
     */
    public function getFilteringStats(array $emails): array
    {
        $stats = [
            'total' => count($emails),
            'filtered' => 0,
            'by_platform' => []
        ];
        
        $filtered = $this->filterBySubject($emails);
        $stats['filtered'] = count($filtered);
        
        foreach ($filtered as $email) {
            $platform = $email['matched_platform'] ?? 'unknown';
            if (!isset($stats['by_platform'][$platform])) {
                $stats['by_platform'][$platform] = 0;
            }
            $stats['by_platform'][$platform]++;
        }
        
        return $stats;
    }

    /**
     * Recargar patrones desde settings (útil cuando se actualizan settings)
     */
    public function reloadPatterns(): void
    {
        SettingsRepository::clearCache();
        $this->subjectPatternsCache = [];
        $this->loadSubjectPatterns();
    }
}