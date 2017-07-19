<?php 
	
	
	$n = Transaction::create(
		[
			'amount' => 1000,
			'naration' => 'cash transfered to blah',
			'transaction_mode' => 21, 
			'account_id' => 220
		],

		[
			[
				'amount' => 1000,
				'naration' => 'cash transfered to blah',
				'transaction_mode' => 21, 
				'account_id' => 220
			],

			[
				'amount' => 1000,
				'naration' => 'cash transfered to blah',
				'transaction_mode' => 21, 
				'account_id' => 220
			],
		]
	);


	$n = Transaction::create(
		[
			'debit' => [
				23112 => [
					'amount' => 1000,
					'naration' => 'cash transfered to blah',
					'transaction_mode' => 21, 
					'account_id' => 220
				],


			],

			'credit' => [
				343 => [
					'amount' => 5000,
					'naration' => 'cash transfered to blah',
					'transaction_mode' => 21, 
					'account_id' => 220
				],

				454 => [
					'amount' => 1000,
					'naration' => 'cash transfered to blah',
					'transaction_mode' => 21, 
					'account_id' => 220
				]
			]

		]
	);






?>