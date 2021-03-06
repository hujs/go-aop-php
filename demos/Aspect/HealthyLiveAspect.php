<?php
/**
 * Go! OOP&AOP PHP framework
 *
 * @copyright     Copyright 2012, Lissachenko Alexander <lisachenko.it@gmail.com>
 * @license       http://www.opensource.org/licenses/mit-license.php The MIT License
 */

namespace Aspect;

use Go\Aop\Aspect;
use Go\Aop\Intercept\MethodInvocation;
use Go\Lang\Annotation\After;
use Go\Lang\Annotation\Before;
use Go\Lang\Annotation\Pointcut;

/**
 * Healthy live aspect
 */
class HealthyLiveAspect implements Aspect
{
    /**
     * Pointcut for eat method
     *
     * @Pointcut("execution(public Example\Human->eat(*))")
     */
    protected function humanEat() {}

    /**
     * Washing hands before eating
     *
     * @param MethodInvocation $invocation Invocation
     * @Before(pointcut="humanEat()") // Short pointcut name (for same class)
     */
    protected function washUpBeforeEat(MethodInvocation $invocation)
    {
        /** @var $person \Human */
        $person = $invocation->getThis();
        $person->washUp();
    }

    /**
     * Method that advices to clean the teeth after eating
     *
     * @param MethodInvocation $invocation Invocation
     * @After(pointcut="Aspect\HealthyLiveAspect->humanEat()") // Full-qualified pointcut name
     */
    protected function cleanTeethAfterEat(MethodInvocation $invocation)
    {
        /** @var $person \Human */
        $person = $invocation->getThis();
        $person->cleanTeeth();
    }

    /**
     * Method that advice to clean the teeth before going to sleep
     *
     * @param MethodInvocation $invocation Invocation
     * @Before("execution(public Example\Human->sleep(*))")
     */
    protected function cleanTeethBeforeSleep(MethodInvocation $invocation)
    {
        /** @var $person \Human */
        $person = $invocation->getThis();
        $person->cleanTeeth();
    }
}
