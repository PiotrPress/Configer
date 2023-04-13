<?php declare( strict_types = 1 );

namespace PiotrPress;

class Configer implements \IteratorAggregate, \ArrayAccess, \Countable {
    protected string $file = '';
    protected array $data = [];

    public function __construct( string $file, array $default = [], array $context = [] ) {
        $this->file = $file;

        if ( $context ) \extract( $context, \EXTR_SKIP );

        $data = \is_file( $this->file ) ? require( $this->file ) : [];
        $this->data = \is_array( $data ) ? \array_merge( $default, $data ) : [];
    }

    public function save() : bool {
        return (bool)\file_put_contents(
            $this->file,
            \sprintf( '<?php return %s;', \var_export( $this->data, true ) )
        );
    }

    public function toArray() : array {
        return $this->data;
    }

    public function offsetExists( $offset ) : bool {
        return isset( $this->data[ $offset ] );
    }

    public function offsetGet( $offset ) : mixed {
        return $this->data[ $offset ] ?? null;
    }

    public function offsetSet( $offset, $value ) : void {
        if ( \is_null( $offset ) ) $this->data[] = $value;
        else $this->data[ $offset ] = $value;
    }

    public function offsetUnset( $offset ) : void {
        \unset( $this->data[ $offset ] );
    }

    public function getIterator() : \Traversable {
        return new \ArrayIterator( $this->data );
    }

    public function count() : int {
        return \count( $this->data );
    }
}