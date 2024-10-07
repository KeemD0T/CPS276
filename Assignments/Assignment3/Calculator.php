<?php
class Calculator {
    public function calc($operator, $num1 = null, $num2 = null) {
        if (!$this->isValidOperator($operator)) {
            return "Error: Invalid operator. Please use one of the following: +, -, *, /<br>";
        }

        if (!is_numeric($num1) || !is_numeric($num2)) {
            return "Error: Both arguments must be numbers.<br>";
        }

        switch ($operator) {
            case '+':
                return "Success: The result of adding $num1 and $num2 is " . $this->add($num1, $num2) . "<br>";
            case '-':
                return "Success: The result of subtracting $num2 from $num1 is " . $this->subtract($num1, $num2) . "<br>";
            case '*':
                return "Success: The result of multiplying $num1 and $num2 is " . $this->multiply($num1, $num2) . "<br>";
            case '/':
                return $this->divide($num1, $num2);
        }
    }

    private function isValidOperator($operator) {
        return in_array($operator, ['+', '-', '*', '/']);
    }

    private function add($num1, $num2) {
        return $num1 + $num2;
    }

    private function subtract($num1, $num2) {
        return $num1 - $num2;
    }

    private function multiply($num1, $num2) {
        return $num1 * $num2;
    }

    private function divide($num1, $num2) {
        if ($num2 == 0) {
            return "Error: Cannot divide by zero.<br>";
        }
        return "Success: The result of dividing $num1 by $num2 is " . ($num1 / $num2) . "<br>";
    }
}
?>


