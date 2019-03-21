<?php
namespace XML;

use Plivo\XML\Response;
use Plivo\Tests\BaseTestCase;

/**
 * Class EmphasisTest
 * @package Plivo\Tests\XML
 */
class EmphasisTest extends BaseTestCase 
{
    
    function testEmphasis()
    {
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $response->addSpeak('Hello,',$params1)
            ->addBreak()
            ->addEmphasis('Welcome',array('level'=>'strong'))
            ->continueSpeak('to Plivo');
        
        $ssml = $response->toXML(true);

        self::assertNotNull($ssml);

        self::assertXmlStringEqualsXmlFile(__DIR__ . '/../Mocks/emphasis.xml',$ssml);
    }

    function testExceptionEmphasis()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $response = new Response();
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );

        $response->addSpeak('Hello,',$params1)
            ->addBreak()
            ->addEmphasis('',array('level'=>'strong'))
            ->continueSpeak('to Plivo');
    }

    function testExceptionAttributeEmphasis()
    {
        $this->expectPlivoException('Plivo\Exceptions\PlivoXMLException');
        $params1 = array(
            'language' => 'en-US',
            'voice' => 'Polly.Joanna'  
        );
        $response = new Response();
        $response->addSpeak('Hello,',$params1)
            ->addBreak()
            ->addEmphasis('Welcome',array('levels'=>'strong'))
            ->continueSpeak('to Plivo');
    }
}