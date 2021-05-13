<?php

namespace Prokl\RequestValidatorBundle\Annotation;

use RuntimeException;
use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 *
 */
class Validator
{
    /**
     * @var string $name
     */
    private $name;

    /**
     * @var array|Constraint[]
     */
    private $constraints = [];

    /**
     * @var boolean
     */
    private $required = false;

    /**
     * @var mixed
     */
    private $default = null;

    /**
     * Validator constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        /**
         * @var string $key
         * @var mixed  $value
         */
        foreach ($values as $key => $value) {
            if (!method_exists($this, $name = 'set' . $key)) {
                throw new RuntimeException(sprintf('Unknown key "%s" for annotation "@%s".', $key, static::class));
            }

            $this->$name($value);
        }
    }

    /**
     * @return string
     */
    public function getAliasName() : string
    {
        return 'request_validator';
    }

    /**
     * @return boolean
     */
    public function allowArray() : bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return void
     */
    public function setName($name) : void
    {
        $this->name = (string)$name;
    }

    /**
     * @return array|Constraint[]
     */
    public function getConstraints() : array
    {
        return $this->constraints;
    }

    /**
     * @param array $constraints
     *
     * @return void
     */
    public function setConstraints(array $constraints) : void
    {
        $this->constraints = $constraints;
    }

    /**
     * @param string|integer $key
     *
     * @return void
     */
    public function removeConstraint($key) : void
    {
        unset($this->constraints[$key]);
    }

    /**
     * @param Constraint $constraint
     *
     * @return void
     */
    public function addConstraint(Constraint $constraint) : void
    {
        $this->constraints[] = $constraint;
    }

    /**
     * @return mixed
     */
    public function getDefault()
    {
        return $this->default;
    }

    /**
     * @param mixed $default
     *
     * @return void
     */
    public function setDefault($default) : void
    {
        $this->default = $default;
    }

    /**
     * @return boolean
     */
    public function isRequired() : bool
    {
        return $this->required;
    }

    /**
     * @return boolean
     */
    public function isOptional() : bool
    {
        return !$this->required;
    }

    /**
     * @param boolean $required
     *
     * @return void
     */
    public function setRequired($required) : void
    {
        $this->required = $required;
    }
}
