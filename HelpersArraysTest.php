<?php

use Illuminate\Support\Arr;

class HelpersArraysTest extends TestCase {

	public function testArrayAdd()
	{
		$array1 = ['name' => 'John Doe', 'age' => 32];
		$array2 = ['name' => 'John Doe', 'age' => 32, 'job' => 'Web Developer'];
		$this->assertEquals($array2, Arr::add($array1, 'job', 'Web Developer'));

		$array1 = ['name' => 'John Doe', 'age' => 32];
		$array2 = ['name' => 'John Doe', 'age' => 32];
		$this->assertEquals($array2, Arr::add($array1, 'age', 25));

		$array1 = ['name' => 'John Doe', 'age' => 32];
		$array2 = [
			'name' => 'John Doe',
			'age' => 32,
			'kids' => [
				[
					'name' => 'Baby Doe',
					'age' => 1
				]
			]
		];
		$this->assertEquals($array2, Arr::add($array1, 'kids.0', ['name' => 'Baby Doe', 'age' => 1]));
	}

	public function testArrayBuild()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::build($array1, function($key, $value) {
			return [$value['id'], $value['name']];
		});
		$this->assertEquals($array2, [
			1 => 'John Doe',
			2 => 'Jane Doe',
			3 => 'Jack Doe'
		]);
	}

	public function testArrayCollapse()
	{
		$array1 = [
			[1,2,3],
			[4,5,6],
			[7,8,9]
		];
		$array2 = Arr::collapse($array1);
		$this->assertEquals($array2, [1,2,3,4,5,6,7,8,9]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$array2 = Arr::collapse($array1);
		$this->assertEquals($array2, ['id' => 2, 'name' => 'Jane Doe']);
	}

	public function testArrayDivide()
	{
		$array1 = [1,2,3];
		$array2 = Arr::divide($array1);
		$this->assertEquals($array2, [
			[0,1,2],
			[1,2,3]
		]);

		$array1 = ['id' => 1, 'name' => 'John Doe'];
		$array2 = Arr::divide($array1);
		$this->assertEquals($array2, [
			['id', 'name'],
			[1, 'John Doe']
		]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$array2 = Arr::divide($array1);
		$this->assertEquals($array2, [
			[0,1],
			[
				['id' => 1, 'name' => 'John Doe'],
				['id' => 2, 'name' => 'Jane Doe']
			]
		]);
	}

	public function testArrayDot()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$array2 = Arr::dot($array1);
		$this->assertEquals($array2, [
			'0.id' => 1,
			'0.name' => 'John Doe',
			'1.id' => 2,
			'1.name' => 'Jane Doe'
		]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$array2 = Arr::dot($array1, 'prefix');
		$this->assertEquals($array2, [
			'prefix0.id' => 1,
			'prefix0.name' => 'John Doe',
			'prefix1.id' => 2,
			'prefix1.name' => 'Jane Doe'
		]);
	}

	public function testArrayExcept()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$array2 = Arr::except($array1, 0);
		$this->assertEquals($array2, [
			1 => ['id' => 2, 'name' => 'Jane Doe']
		]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$array2 = Arr::except($array1, [0, 1]);
		$this->assertEquals($array2, []);

		$array1 = ['id' => 1, 'name' => 'John Doe'];
		$array2 = Arr::except($array1, 'id');
		$this->assertEquals($array2, ['name' => 'John Doe']);
	}

	public function testArrayFetch()
	{
		$array1 = [
			[
				'name' => 'John Doe',
				'age' => 32,
				'kids' => [
					'name' => 'Baby Doe',
					'age' => 1
				]
			],
			[
				'age' => 22,
				'name' => 'Jane Doe',
				'kids' => [
					'name' => 'Junior Doe',
					'age' => 15
				]
			]
		];
		$array2 = Arr::fetch($array1, 'kids.name');
		$this->assertEquals($array2, [
			'Baby Doe',
			'Junior Doe'
		]);
	}

	public function testArrayFirst()
	{
		$array1 = [1,2,3];
		$first = Arr::first($array1, function($key, $value) {
			return $key == 0;
		}, [1,2,3]);
		$this->assertEquals($first, 1);

		$array1 = [1,2,3];
		$first = Arr::first($array1, function($key, $value) {
			return $key > 2;
		}, [1,2,3]);
		$this->assertEquals($first, [1,2,3]);
	}

	public function testArrayFlatten()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$array2 = Arr::flatten($array1);
		$this->assertEquals($array2, [1, 'John Doe', 2, 'Jane Doe']);

		$array1 = [
			['id' => 1, 'name' => 'John Doe', 'skills' => []],
			['id' => 2, 'name' => 'Jane Doe', ['skills' => ['smart', 'pretty']]]
		];
		$array2 = Arr::flatten($array1);
		$this->assertEquals($array2, [1, 'John Doe', 2, 'Jane Doe', 'smart', 'pretty']);
	}

	public function testArrayForget()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		Arr::forget($array1, '0.id');
		$this->assertEquals($array1, [
			['name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		Arr::forget($array1, ['0.id', '1.name']);
		$this->assertEquals($array1, [
			['name' => 'John Doe'],
			['id' => 2]
		]);
	}

	public function testArrayGet()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$result = Arr::get($array1, '1.name');
		$this->assertEquals($result, 'Jane Doe');

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$result = Arr::get($array1, '11.name', [1,2,3]);
		$this->assertEquals($result, [1,2,3]);
	}

	public function testArrayHas()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$result = Arr::has($array1, '1.name');
		$this->assertEquals($result, true);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		];
		$result = Arr::has($array1, '2.name');
		$this->assertEquals($result, false);
	}

	public function testArrayLast()
	{
		$array1 = [1,2,3];
		$last = Arr::last($array1, function($key, $value) {
			return $key == 0;
		}, [1,2,3]);
		$this->assertEquals($last, 3);

		$array1 = [1,2,3];
		$result = Arr::last($array1, function($key, $value) {
			return $key > 2;
		}, [1,2,3]);
		$this->assertEquals($result, [1,2,3]);
	}

	public function testArrayOnly()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::only($array1, 1);
		$this->assertEquals($array2, [
			1 => ['id' => 2, 'name' => 'Jane Doe']
		]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::only($array1, [1,2]);
		$this->assertEquals($array2, [
			1 => ['id' => 2, 'name' => 'Jane Doe'],
			2 => ['id' => 3, 'name' => 'Jack Doe']
		]);
	}

	public function testArrayPluck()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::pluck($array1, 'id');
		$this->assertEquals($array2, [1,2,3]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::pluck($array1, 'name');
		$this->assertEquals($array2, ['John Doe','Jane Doe','Jack Doe']);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::pluck($array1, 'name', 'id');
		$this->assertEquals($array2, [
			1 => 'John Doe',
			2 => 'Jane Doe',
			3 => 'Jack Doe'
		]);
	}

	public function testArrayPull()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::pull($array1, 0);
		$this->assertEquals($array1, [
			1 => ['id' => 2, 'name' => 'Jane Doe'],
			2 => ['id' => 3, 'name' => 'Jack Doe']
		]);
		$this->assertEquals($array2, ['id' => 1, 'name' => 'John Doe']);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::pull($array1, 4, [1,2,3]);
		$this->assertEquals($array1, [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		]);
		$this->assertEquals($array2, [1,2,3]);
	}

	public function testArraySet()
	{
		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		Arr::set($array1, '3.id', 4);
		$this->assertEquals($array1, [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe'],
			['id' => 4]
		]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		Arr::set($array1, null, [1,2,3]);
		$this->assertEquals($array1, [1,2,3]);
	}

	public function testArraySort()
	{
		$array1 = [9,68,19];
		$array2 = Arr::sort($array1, function($value, $key) {
			return $value;
		});
		$this->assertEquals($array2, [
			0 => 9,
			2 => 19,
			1 => 68
		]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::sort($array1, function($value, $key) {
			return $value['name'];
		});
		$this->assertEquals($array2, [
			2 => ['id' => 3, 'name' => 'Jack Doe'],
			1 => ['id' => 2, 'name' => 'Jane Doe'],
			0 => ['id' => 1, 'name' => 'John Doe']
		]);
	}

	public function testArrayWhere()
	{
		$array1 = [1,2,3];
		$array2 = Arr::where($array1, function($key, $value) {
			return $value > 2;
		});
		$this->assertEquals($array2, [2 => 3]);

		$array1 = [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe'],
			['id' => 3, 'name' => 'Jack Doe']
		];
		$array2 = Arr::where($array1, function($key, $value) {
			return $value['id'] > 2;
		});
		$this->assertEquals($array2, [
			2 => ['id' => 3, 'name' => 'Jack Doe']
		]);
	}

}
