<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class LangTest
 * @package Plivo\Tests\XML
 */
class LangTest extends BaseTestCase 
{
    
    function testAddLang()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-IN',
            'voice' => 'Polly.Aditi'  
        );

        $response->addSpeak('Hello,',$params1)
            ->continueSpeak('Welcome to Plivo')
            ->addLang('hallo, plivo mein aapaka svaagat hai',array('xmllang'=>'hi-IN'));
        $ssml = $response->toXML(true);
        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/langSpeak.xml',$ssml);
    }

    function testExceptionAddLang()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $params1 = array(
            'language' => 'en-IN',
            'voice' => 'Polly.Aditi'  
        );
        $response = new Response();
        $response->addSpeak('Hello,',$params1)
            ->continueSpeak('Welcome to Plivo')
            ->addLang('hallo, plivo mein aapaka svaagat hai',array('xmlLang'=>'hi-IN'));
    }

}