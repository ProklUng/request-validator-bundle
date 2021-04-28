<?php

namespace Prokl\RequestValidatorBundle\Exceptions;

use Symfony\Component\HttpFoundation\Exception\RequestExceptionInterface;

/**
 * Class ValidateErrorException
 * @package Prokl\RequestValidatorBundle\Exceptions
 *
 * @sinсe 05.04.2021
 */
class ValidateErrorException extends BaseException implements RequestExceptionInterface
{

}
