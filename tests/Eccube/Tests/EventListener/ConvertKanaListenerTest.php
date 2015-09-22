<?php

namespace Eccube\Tests\EventListener;

use Symfony\Component\Form\FormEvent;
use Eccube\EventListner\ConvertKanaListener;

class ConvertKanaListenerTest extends \PHPUnit_Framework_TestCase
{
    public function testConvertKana_string()
    {
        $data = '１２３４５';
        $form = $this->getMock('Symfony\Component\Form\Test\FormInterface');
        $event = new FormEvent($form, $data);

        $filter = new ConvertKanaListener();
        $filter->onPreSubmit($event);

        $this->assertEquals('12345', $event->getData());
    }

    public function testConvertKana_array()
    {
        $data = array('１２３４５');
        $form = $this->getMock('Symfony\Component\Form\Test\FormInterface');
        $event = new FormEvent($form, $data);

        $filter = new ConvertKanaListener();
        $filter->onPreSubmit($event);

        $this->assertEquals(array('12345'), $event->getData());
    }

    public function testConvertKana_HiraganaToKana()
    {
        $data = 'あいうえお';
        $form = $this->getMock('Symfony\Component\Form\Test\FormInterface');
        $event = new FormEvent($form, $data);

        $filter = new ConvertKanaListener('CV');
        $filter->onPreSubmit($event);

        $this->assertEquals('アイウエオ', $event->getData());
    }
}