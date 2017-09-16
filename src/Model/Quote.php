<?php
/**
 * Author: Brian Teachman
 * Date: 9/14/2017
 */

namespace Api\Model;

class Quote
{
    /**
     * $quote_data = [
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
    public $quotes;

    public function __construct(array $data) {
        $this->quotes = $data;
    }

    public function getQuotes(string $doctor_number): array {
        return $this->quotes[$doctor_number]['quotes'];
    }

    public function listQuotes() {
        foreach ($this->quotes as $doctor) {
            foreach ($doctor['quotes'] as $quote) {
                echo sprintf('%s — %s', $quote, $doctor['name']);
            }
        }
    }

    public function getRandomDrNum(): int {
        return random_int(0, 12);
    }

    public function getRandQuoteNum(array $queue): int {
        return random_int(0, count($queue)-1);
    }

    public function getRandomQuote(): string {
	    $dr_num = $this->getRandomDrNum();
        $doctor = $this->quotes[$dr_num];
        $qnum = $this->getRandQuoteNum($doctor['quotes']);
        return sprintf('%s — %s', $doctor['quotes'][ $qnum ], $doctor['name']);
    }

    public function getTotalQuotes(): int {
        $total = 0;
        foreach ($this->quotes as $doctor) {
            foreach ($doctor['quotes'] as $quote) {
                $total += 1;
            }
        }
        return $total;
    }

    public function getSourceName($dr_num): string {
    	return $this->quotes[$dr_num]['name'];
    }
}
