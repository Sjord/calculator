<?php

	$exp = "(23 + 3)*5/(6-3)";
	$rpn = mathexp_to_rpn($exp); // = 43.3333333
	echo "$exp\n";
	print_r($rpn);
	print_r(calculate_rpn($rpn));

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
			echo "\n".$item."\n";
			print_r($stack);
		}
		return $stack;
	}

	function mathexp_to_rpn($mathexp) {
		$i = 0;
		$final_stack = array();
		$operator_stack = array();

		while ($i < strlen($mathexp)) {
			$char = $mathexp{$i};
			if ($char == '(') {
				$i++; continue;
			}
			if ($char >= '0' && $char <= '9') {
				$num = readnumber($mathexp, $i);
				array_push($final_stack, $num);
				$i += strlen($num); continue;
			}
			if (is_operator($char)) {
				array_push($operator_stack, $char);
				$i++; continue;
			}
			if ($char == ')') {
				// transfer operator to final stack
				$operator = array_pop($operator_stack);
				array_push($final_stack, $operator);
				$i++; continue;
			}
			$i++;
		}
		echo "klaar!\n";
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
