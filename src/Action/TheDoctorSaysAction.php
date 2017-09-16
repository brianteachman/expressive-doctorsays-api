<?php

namespace Api\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Api\Model\Quote;

class TheDoctorSaysAction implements ServerMiddlewareInterface
{
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
	    // PHP 7+: Null coalescing operator (??)
//	    $dr_num = $request->getQueryParams()['dr_num'] ?? null;
	    $dr_num = $request->getAttribute('dr_num');

	    $dq = include( 'data/doctor_quotes.php' );
	    $q = new Quote($dq);

	    if ($dr_num) {
			$quote = $q->getQuotes($dr_num)[0]; // @TODO Add queryable tagging metrics
		    $quote = sprintf('%s — %s', $quote, $q->getSourceName($dr_num));
	    }
	    else {
	    	$quote = $q->getRandomQuote();
	    }

	    return new JsonResponse(['get_param' => $dr_num, 'dr_says' => $quote]);
    }
}
