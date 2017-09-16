<?php

namespace ApiTest\Model;

use Api\Model\Quote;
use PHPUnit\Framework\TestCase;

class QuoteTest extends TestCase
{
	/**
	 * $data = [
	 *   [
	 *     'name' => 'Quote Author',
	 *     'quotes' => [
	 *        'Quote 1',
	 *        'Quote 2',
	 *        ...
	 *      ]
	 *   ],
	 *   ...
	 * ]
	 */
	private $data;
	private $quote;

	function setUp()
	{
		parent::setUp();
		$this->data = include('data/doctor_quotes.php');
		$this->quote = new Quote($this->data);
	}

	function tearDown()
	{
		parent::tearDown();
		$this->quote = null;
	}

	public function testNewQuote()
	{
		$this->assertInstanceOf(Quote::class, $this->quote);
	}

	public function testIncludedDataLoaded()
	{
		$this->assertArrayHasKey('name', $this->quote->quotes[0]);
		$this->assertArrayHasKey('quotes', $this->quote->quotes[0]);
		$this->assertEquals($this->quote->quotes, $this->data);
	}

	public function testGetQuotes()
	{
		$firstDr_Quotes = $this->quote->getQuotes(1);
		$this->assertEquals($this->data[1]['quotes'], $firstDr_Quotes);

		$secondDr_FirstQuote = $this->quote->getQuotes(2)[0];
		$this->assertEquals($this->data[2]['quotes'][0], $secondDr_FirstQuote);
	}

	public function testQuoteCount()
	{
		$quote_count = $this->quote->getTotalQuotes();
		$this->assertEquals(80, $quote_count); // atm, I know there is 80...
	}

	// @TODO should be implemention of interface that uses Quote->randNum(int:min, int:max)
	function testGetRandomDrNumBetween0and12()
	{
		for ($i=0; $i<100; $i++) {
			$rand_dr_num = $this->quote->getRandomDrNum();
			$is_true = (0 <= $rand_dr_num && $rand_dr_num <= 12); // 12 Doctors
			$this->assertTrue($is_true);
		}
	}

	// @TODO should be implemention of interface that uses Quote->randNum(int:min, int:max)
	function testGetRandQuoteNum()
	{
		for ($i=0; $i<100; $i++) {
			// I know that there are 4 1st Doctor quotes (atm)
			$rand_quote_num = $this->quote->getRandQuoteNum($this->quote->getQuotes(1));
			$is_true = (0 <= $rand_quote_num && $rand_quote_num < count($this->quote->getQuotes(1)));
			$this->assertTrue($is_true);
		}
	}
}
