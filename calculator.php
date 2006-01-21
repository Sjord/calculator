<?php

	echo "3: ".calculate("(23 + 7)/(13 - 3)")."\n";
	echo "3: ".calculate("(120 / (1 + 9 / 3) / 10")."\n";
	echo "3: ".calculate("3 + 3 - 3 * 3 / 3")."\n";
	echo "0.60: ".calculate("1 + 2 - 3  * 4 / 5")."\n";

	function calculate($exp) {
		return calculate_rpn(mathexp_to_rpn($exp));
	}

	function calculate_rpn($rpnexp) {
		$stack = array();
		foreach($rpnexp as $item) {
			if (is_operator($item)) {
				if ($item == '+') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i + $j);
				}
				if ($item == '-') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i - $j);
				}
				if ($item == '*') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i * $j);
				}
				if ($item == '/') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i / $j);
				}
				if ($item == '%') {
					$j = array_pop($stack);
					$i = array_pop($stack);
					array_push($stack, $i % $j);
				}
			} else {
				array_push($stack, $item);
			}
		}
		return $stack[0];
	}

	function mathexp_to_rpn($mathexp) {
		$precedence = array(
			'(' => 0,
			'-' => 3,
			'+' => 3,
			'*' => 6,
			'/' => 6,
			'%' => 6
		);
	
		$i = 0;
		$final_stack = array();
		$operator_stack = array();

		while ($i < strlen($mathexp)) {
			$char = $mathexp{$i};
			if ($char >= '0' && $char <= '9') {
				$num = readnumber($mathexp, $i);
				array_push($final_stack, $num);
				$i += strlen($num); continue;
			}
			if (is_operator($char)) {
				$top = end($operator_stack);
				if ($top && $precedence[$char] <= $precedence[$top]) {
					$oper = array_pop($operator_stack);
					array_push($final_stack, $oper);
				}
				array_push($operator_stack, $char);
				$i++; continue;
			}
			if ($char == '(') {
				array_push($operator_stack, $char);
				$i++; continue;
			}
			if ($char == ')') {
				// transfer operators to final stack
				do {
					$operator = array_pop($operator_stack);
					if ($operator == '(') break;
					array_push($final_stack, $operator);
				} while ($operator);
				$i++; continue;
			}
			$i++;
		}
		while ($oper = array_pop($operator_stack)) {
			array_push($final_stack, $oper);
		}
		return $final_stack;
	}

	function readnumber($string, $i) {
		$number = '';
		while ($string{$i} >= '0' && $string{$i} <= '9') {
			$number .= $string{$i};
			$i++;
		}
		return $number;
	}

	function is_operator($char) {
		static $operators = array('+', '-', '/', '*', '%');
		return in_array($char, $operators);
	}
?>
