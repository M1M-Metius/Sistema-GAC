"""
GAC - Módulo de Base de Datos para Scripts Python
"""

import mysql.connector
from mysql.connector import Error
from cron.config import DB_CONFIG, WAREHOUSE_DB_CONFIG
import logging

logger = logging.getLogger(__name__)


class Database:
    """Maneja conexiones a las bases de datos"""
    
    _operational_connection = None
    _warehouse_connection = None
    
    @classmethod
    def get_connection(cls):
        """Obtener conexión a BD operativa"""
        if cls._operational_connection is None or not cls._operational_connection.is_connected():
            try:
                cls._operational_connection = mysql.connector.connect(
                    host=DB_CONFIG['host'],
                    port=DB_CONFIG['port'],
                    database=DB_CONFIG['database'],
                    user=DB_CONFIG['user'],
                    password=DB_CONFIG['password'],
                    charset='utf8mb4',
                    collation='utf8mb4_spanish_ci',
                    autocommit=False
                )
                logger.info("Conexión a BD operativa establecida")
            except Error as e:
                logger.error(f"Error al conectar con BD operativa: {e}")
                raise
        
        return cls._operational_connection
    
    @classmethod
    def get_warehouse_connection(cls):
        """Obtener conexión a BD warehouse"""
        if cls._warehouse_connection is None or not cls._warehouse_connection.is_connected():
            try:
                cls._warehouse_connection = mysql.connector.connect(
                    host=WAREHOUSE_DB_CONFIG['host'],
                    port=WAREHOUSE_DB_CONFIG['port'],
                    database=WAREHOUSE_DB_CONFIG['database'],
                    user=WAREHOUSE_DB_CONFIG['user'],
                    password=WAREHOUSE_DB_CONFIG['password'],
                    charset='utf8mb4',
                    collation='utf8mb4_spanish_ci',
                    autocommit=False
                )
                logger.info("Conexión a BD warehouse establecida")
            except Error as e:
                logger.error(f"Error al conectar con BD warehouse: {e}")
                raise
        
        return cls._warehouse_connection
    
    @classmethod
    def close_connections(cls):
        """Cerrar todas las conexiones"""
        if cls._operational_connection and cls._operational_connection.is_connected():
            cls._operational_connection.close()
            cls._operational_connection = None
        
        if cls._warehouse_connection and cls._warehouse_connection.is_connected():
            cls._warehouse_connection.close()
            cls._warehouse_connection = None