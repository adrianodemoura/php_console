<?php
declare(strict_types=1);

namespace PhpConsole\Core\Database;
use PhpConsole\Core\Database\Field;
use Exception;
use PDO;

class Mysql extends PDO {

    protected $baseConfig = 
    [
        'persistent'    => true,
        'host'          => 'localhost',
        'username'      => '',
        'password'      => '',
        'database'      => '',
        'port'          => '3306',
        'flags'         => [],
        'encoding'      => 'utf8mb4',
        'timezone'      => null,
        'init'          => [],
    ];

    public function __construct( array $config=[] )
    {

        $this->baseConfig['host']      = isset( $config['host'] ) 
            ? $config['host'] 
            : 'localhost';

        $this->baseConfig['username']  = isset( $config['username'] )
            ? $config['username'] 
            : '';

        $this->baseConfig['password']  = isset( $config['password'] )
            ? $config['password'] 
            : '';

        $this->baseConfig['database']  = isset( $config['database'] )
            ? $config['database'] 
            : '';

        $this->baseConfig['port']      = isset( $config['port'] )
            ? $config['port'] 
            : 3306;

        $this->baseConfig['init']      = isset( $config['init'] )
            ? $config['init']
            : '';

        $this->initDb();
    }

    private function initDb()
    {
        try 
        {
            $dsn = "mysql:host={$this->baseConfig['host']};dbname={$this->baseConfig['database']};port={$this->baseConfig['port']}";

            parent::__construct( $dsn, $this->baseConfig['username'], $this->baseConfig['password'] );

            $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

            if ( is_array($this->baseConfig['init']) )
            {
                foreach( $this->baseConfig['init'] as $_l => $_init ) { $this->exec( $_init ); }
            } elseif ( !empty( $this->baseConfig['init'] ) )
            {
                $this->exec( $this->baseConfig['init'] );
            }
        } catch (PDOException $e )
        {
            die( $e->getMessage() );
        }
    }

    public function __destruct()
    {
        $this->conn = null;
    }

    public function version() : string
    {
        return @$this->query( "SELECT version();" )->fetchAll()[0][0];
    }

    public function getSchema( string $table='' ) : array
    {
        $_schema    = $this->query( "describe $table" )->fetchAll();
        $schema     = [];

        foreach( $_schema as $_l => $_arrFields )
        {
            $schema[ $_arrFields['Field'] ]['name']     = $_arrFields['Field'];
            $schema[ $_arrFields['Field'] ]['type']     = Field::getTypeField( $_arrFields['Type'] );
            $schema[ $_arrFields['Field'] ]['default']  = $_arrFields['Default'];
            
            if ( !empty( @$_arrFields['Key'] ) ) 
            {
                $schema[ $_arrFields['Field'] ]['key']      = $_arrFields['Key'];
            }

            $schema[ $_arrFields['Field'] ]['general_type']     = Field::getGeneralType( $schema[ $_arrFields['Field'] ]['type'] );

        }

        return $schema;
    }

    public function allTables() : array
    {

        $_lista = $this->query( "show tables" )->fetchAll();
        $lista  = [];

        foreach( $_lista as $_l => $_prop ) { $lista[] = $_prop['Tables_in_'.$this->baseConfig['database']]; }

        return $lista;
    }
}
