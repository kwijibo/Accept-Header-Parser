<?php
<?php
require_once 'acceptheaderparser.class.php';

class AcceptHeaderParserTest extends PHPUnit_Framework_TestCase {

    var $Accept = false;

    function setUp(){
       $_SERVER['HTTP_ACCEPT'] = 'text/html,application/rdf+xml,application/turtle,text/plain';
        $this->Accept = new AcceptHeaderParser();
    }
    
    function tearDown(){
        
    }
    
   
    function test_getAcceptTypes(){
	
        $_SERVER['HTTP_ACCEPT'] = 'application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5';
	$expected = array('application/xhtml+xml','application/xml','image/png','text/html','text/plain','*/*');
	$actual = $this->Accept->getAcceptTypes();
	$this->assertEquals($expected, $actual);
    }

    function test_getAcceptTypes_any23_acceptHeader(){
     $_SERVER['HTTP_ACCEPT'] = 'text/csv;q=0.1, text/html;q=0.3, application/xhtml+xml;q=0.3, text/rdf+nq;q=0.1, text/nq;q=0.1, text/nquads;q=0.1, text/n-quads;q=0.1, text/nt;q=0.1, text/ntriples;q=0.1, text/plain;q=0.1, text/rdf+n3, text/n3, application/n3, application/x-turtle, application/turtle, text/turtle, application/rdf+xml, text/rdf, text/rdf+xml, application/rdf';
$expected =  array (
  0 => 'application/turtle',
  1 => 'text/turtle',
  2 => 'application/x-turtle',
  3 => 'text/rdf+n3',
  4 => 'text/n3',
  5 => 'application/rdf+xml',
  6 => 'text/rdf',
  7 => 'application/n3',
  8 => 'application/rdf',
  9 => 'text/rdf+xml',
  10 => 'text/html',
  11 => 'application/xhtml+xml',
  12 => 'text/plain',
  13 => 'text/nq',
  14 => 'text/rdf+nq',
  15 => 'text/nquads',
  16 => 'text/n-quads',
  17 => 'text/ntriples',
  18 => 'text/nt',
  19 => 'text/csv',
);
		$actual = $this->Accept->getAcceptTypes();
	$this->assertEquals($expected, $actual);

    }

}

?>
