# Arrays
Laravel5 offers a great way to manipulate arrays through the `Illuminate\Support\Arr` class and its great variety of methods. We can manipulate arrays with very little code which is awesome. Let's see a fast example:

	use Illuminate\Support\Arr;

	$users = Arr::pluck([
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe'],
	], 'name', 'id');
	
	$users = [
		1 => 'John Doe',
		2 => 'Jane Doe',
		3 => 'Jack Doe'
	];
	
	{!!Form::select('users', $users, null')!!}
	
How easy? We created an array with key/value pairs using their id,name values so fast. Now it is ready to apply it to the `Form::select()` method at once (as long as we use the Illuminate Html package of course).

Below every method of Arr class is explained with some brief and declarative examples per method so you can grasp their functionality with ease.

## add()

Add an element to an array by adding a key/value pair. You can also use "dot" notation if it doesn't exist.

**Method:**
	
	public static function add($array, $key, $value);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		'name' => 'John Doe',
		'age' => 32
	]; 
	
	$array2 = Arr::add($array1, 'job', 'Web Developer');
	
**Result:**
	
	$array2 = [
		'name' => 'John Doe',
		'age' => 32,
		'job' => 'Web Developer
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		'name' => 'John Doe',
		'age' => 32
	]; 
	
	$array2 = Arr::add($array1, 'age', '25');
	
**Result:**
	
	$array2 = [
		'name' => 'John Doe',
		'age' => 32
	];
	
**Example 3:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		'name' => 'John Doe',
		'age' => 32
	]; 
	
	$array2 = Arr::add($array1, 'kids.0', ['name' => 'Baby Doe', 'age' => 1]);
	
**Result:**
	
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
	
**Equivalent Helper Function:**

	array_add($array, $key, $value);
	
**Notes:**

In case you try to add a key which already exists then nothing happens and the old array is returned. Also take notice how the dot notation works to create a multidimensional array in an eye blink.

## build()

Build a new array using a callback.

**Method:**
	
	public static function build($array, callable $callback);
	
**Example:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	]; 
	
	$array2 = Arr::build($array1, function($key, $value) {
		return [$value['id'], $value['name']];
	});
	
**Result:**
	
	$array2 = [
		1 => 'John Doe',
		2 => 'Jane Doe',
		3 => 'Jack Doe'
	];

**Equivalent Helper Function:**

	array_build($array, callable $callback);
	
**Notes:**

Inside our fallback we create pairs that are going to become key/value pairs for the newly created array.
	
## collapse()

Collapse an array of arrays into a single array.

**Method:**
	
	public static function collapse($array);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		[1,2,3],
		[4,5,6],
		[7,8,9]
	]; 
	
	$array2 = Arr::collapse($array1);
	
**Result:**
	
	$array2 = [1,2,3,4,5,6,7,8,9];
	
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	]; 
	
	$array2 = Arr::collapse($array1);
	
**Result:**
	
	$array2 = ['id' => 2, 'name' => 'Jane Doe'];

**Equivalent Helper Function:**

	array_collapse($array);
	
**Notes:**

In real life be careful because if you use arrays with strings as keys you might have the overwrite effect.

## divide()

Divide an array into two arrays. One with keys and the other with values.

**Method:**
	
	public static function divide($array);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [1,2,3]; 
	
	$array2 = Arr::divide($array1);
	
**Result:**
	
	$array2 = [
		[0,1,2],
		[1,2,3]
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = ['id' => 1, 'name' => 'John Doe']; 
	
	$array2 = Arr::divide($array1);
	
**Result:**
	
	$array2 = [
		['id', 'name'],
		[1, 'John Doe']
	];
	
**Example 3:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	]; 
	
	$array2 = Arr::divide($array1);
	
**Result:**
	
	$array2 = [
		[0,1],
		[
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Doe']
		]
	];
	
**Equivalent Helper Function:**

	array_divide($array);
	
## dot()

Flatten a multi-dimensional associative array with dots.

**Method:**
	
	public static function dot($array, $prepend = '');
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	]; 
	
	$array2 = Arr::dot($array1);
	
**Result:**
	
	$array2 = [
		'0.id' => 1,
		'0.name' => 'John Doe',
		'1.id' => 2,
		'1.name' => 'Jane Doe'
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	]; 
	
	$array2 = Arr::dot($array1, 'prefix');
	
**Result:**
	
	$array2 = [
		'prefix0.id' => 1,
		'prefix0.name' => 'John Doe',
		'prefix1.id' => 2,
		'prefix1.name' => 'Jane Doe'
	];
	
**Equivalent Helper Function:**

	array_dot($array, $prepend = '');
	
## except()

Get all of the given array except for a specified array of items.

**Method:**
	
	public static function except($array, $keys);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	]; 
	
	$array2 = Arr::except($array1, 0);
	
**Result:**
	
	$array2 = [
		1 => ['id' => 2, 'name' => 'Jane Doe']
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	]; 
	
	$array2 = Arr::except($array1, [0, 1]);
	
**Result:**
	
	$array2 = [];
	
**Example 3:**

	use Illuminate\Support\Arr;
	
	$array1 = ['id' => 1, 'name' => 'John Doe']; 
	
	$array2 = Arr::except($array1, 'id');
	
**Result:**
	
	$array2 = ['name' => 'John Doe'];
	
**Equivalent Helper Function:**

	array_except($array, $keys);
	
**Notes:**

The `$keys` parameter can be a single key or an array of keys. Of course the keys can be integers or strings.

## fetch()

Fetch a flattened array of a nested array element.

**Method:**
	
	public static function fetch($array, $key);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
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
	
**Result:**
	
	$array2 = [
		'Baby Doe',
		'Junior Doe'
	];

**Equivalent Helper Function:**

	array_fetch($array, $key);
	
**Notes:**

By using "dot" notation we search inside a multidimensional array to get values for a specific key.
	
## first()

Return the first element in an array passing a given truth test.

**Method:**
	
	public static function first($array, callable $callback, $default = null);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [1,2,3]; 
	
	$first = Arr::first($array1, function($key, $value) {
		return $key == 0;
	}, [1,2,3]);
	
**Result:**
	
	$first = 1;
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [1,2,3]; 
	
	$first = Arr::first($array1, function($key, $value) {
		return $key > 2;
	}, [1,2,3]);
	
**Result:**
	
	$first = [1,2,3];
	
**Equivalent Helper Function:**

	array_first($array, callable $callback, $default = null);
	
**Notes:**

The callback function is a test for the array parameter. The first element of the array that passes the test is returned. In case there is nothing returned the third parameter which is a callback is returned.

## flatten()

Flatten a multi-dimensional array into a single level.

**Method:**
	
	public static function flatten($array);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
	$array2 = Arr::flatten($array1);
	
**Result:**
	
	$array1 = [1, 'John Doe', 2, 'Jane Doe'];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe', 'skills' => []],
		['id' => 2, 'name' => 'Jane Doe', ['skills' => ['smart', 'pretty']]]
	];
	
	$array2 = Arr::flatten($array1);
	
**Result:**
	
	$array1 = [1, 'John Doe', 2, 'Jane Doe', 'smart', 'pretty'];
	
**Equivalent Helper Function:**

	array_flatten($array);
	
## forget()

Remove one or many array items from a given array using "dot" notation.

**Method:**
	
	public static function forget(&$array, $keys);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
	Arr::forget($array1, '0.id');
	
**Result:**
	
	$array1 = [
		['name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
	Arr::forget($array1, ['0.id', '1.name']);
	
**Result:**
	
	$array1 = [
		['name' => 'John Doe'],
		['id' => 2]
	];
	
**Equivalent Helper Function:**

	array_forget(&$array, $keys);
	
**Notes:**

The `$keys` parameter can be a key or an array of keys. Be careful because this method affects the array itself on which the method applied.

## get()

Get an item from an array using "dot" notation.

**Method:**
	
	public static function get($array, $key, $default = null);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
	$result = Arr::get($array1, '1.name');
	
**Result:**
	
	$result = 'Jane Doe';
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
	$result = Arr::get($array1, '11.name', [1,2,3]);
	
**Result:**
	
	$result = [1,2,3];

**Equivalent Helper Function:**

	array_get($array, $key, $default = null);
	
**Notes:**

The method can take a fallback value in case the 'dot' notation key we ask for doesn't exist.

## has()

Check if an item exists in an array using "dot" notation.

**Method:**
	
	public static function has($array, $key);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
	$result = Arr::has($array1, '1.name');
	
**Result:**
	
	$result = true;
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe']
	];
	
	$result = Arr::has($array1, '2.name');
	
**Result:**
	
	$result = false;
	
**Equivalent Helper Function:**

	array_has($array, $key);

## last()

Return the last element in an array passing a given truth test.

**Method:**
	
	public static function last($array, callable $callback, $default = null);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [1,2,3]; 
	
	$last = Arr::last($array1, function($key, $value) {
		return $key == 0;
	}, [1,2,3]);
	
**Result:**
	
	$last = 3;
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [1,2,3]; 
	
	$last = Arr::last($array1, function($key, $value) {
		return $key > 2;
	}, [1,2,3]);
	
**Result:**
	
	$last = [1,2,3];
	
**Equivalent Helper Function:**

	array_last($array, $callback, $default = null);
	
**Notes:**
	
The callback function is a test for the array parameter. The last element of the array that could pass the test is returned. In case there is nothing returned the third parameter which is a callback is returned. This method uses the `first()` merhod, first calculates the first element that passes the test and then uses the `array_reverse()` method to return the array in reverse order and takes the first one from it.
	
## only()

Get a subset of the items from the given array.

**Method:**
	
	public static function only($array, $keys);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::only($array1, 1);
	
**Result:**
	
	$array2 = [
		1 => ['id' => 2, 'name' => 'Jane Doe']
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::only($array1, [1,2]);
	
**Result:**
	
	$array2 = [
		1 => ['id' => 2, 'name' => 'Jane Doe'],
		2 => ['id' => 3, 'name' => 'Jack Doe']
	];

**Equivalent Helper Function:**

	array_only($array, $keys);
	
**Notes:**

The `$keys` parameter can be a single key or an array of keys. In both cases the result is an array and all selected elements retain their keys as before.

## pluck()

Pluck an array of values from an array.

**Method:**
	
	public static function pluck($array, $value, $key = null);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::pluck($array1, 'id');
	
**Result:**
	
	$array2 = [1,2,3];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::pluck($array1, 'name');
	
**Result:**
	
	$array2 = ['John Doe','Jane Doe','Jack Doe'];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::pluck($array1, 'name', 'id');
	
**Result:**
	
	$array2 = [
		1 => 'John Doe',
		2 => 'Jane Doe',
		3 => 'Jack Doe'
	];
	
**Equivalent Helper Function:**

	array_pluck($array, $value, $key = null);
	
**Notes:**

This method is very useful and can create an array of values for specific elements key. Even better if the third parameter is assigned to another key it can create an array with key/value pairs the values of the selected keys.

## pull()

Get a value from the array, and remove it.

**Method:**
	
	public static function pull(&$array, $key, $default = null);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::pull($array1, 0);
	
**Result:**

	$array1 = [
		1 => ['id' => 2, 'name' => 'Jane Doe'],
		2 => ['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = ['id' => 1, 'name' => 'John Doe'];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::pull($array1, 4, [1,2,3]);
	
**Result:**

	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = [1,2,3];
	
**Equivalent Helper Function:**

	array_pull(&$array, $key, $default = null);
	
**Notes:**

This method returns the selected value but affects also the array by removing it. If the element doesn't exist then a fallback is returned. Be careful that the values of the old array retain their old keys.

## set()

Set an array item to a given value using "dot" notation.

**Method:**
	
	public static function set(&$array, $key, $value);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	Arr::set($array1, '3.id', 4);
	
**Result:**

	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe'],
		['id' => 4]
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	Arr::set($array1, null, [1,2,3]);
	
**Result:**

	$array1 = [1,2,3];
	
**Equivalent Helper Function:**

	array_set(&$array, $key, $value);
	
**Notes:**

If no `$key` parameter is passed then the whole array is replaced by the $value parameter. Be careful because this method updates the array itself.

## sort()

Sort the array using the given callback.

**Method:**
	
	public static function sort($array, callable $callback);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [9,68,19];
	
	$array2 = Arr::sort($array1, function($value, $key) {
		return $value;
	});
	
**Result:**

	$array2 = [
		0 => 9,
		2 => 19,
		1 => 68
	];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::sort($array1, function($value, $key) {
		return $value['name'];
	});
	
**Result:**

	$array2 = [
		2 => ['id' => 3, 'name' => 'Jack Doe'],
		1 => ['id' => 2, 'name' => 'Jane Doe'],
		0 => ['id' => 1, 'name' => 'John Doe']
	];
	
**Equivalent Helper Function:**

	array_sort($array, callable $callback);
	
## where()

Filter the array using the given callback.

**Method:**
	
	public static function where($array, callable $callback);
	
**Example 1:**

	use Illuminate\Support\Arr;
	
	$array1 = [1,2,3];
	
	$array2 = Arr::where($array1, function($key, $value) {
		return $value > 2;
	});
	
**Result:**

	$array2 = [2 => 3];
	
**Example 2:**

	use Illuminate\Support\Arr;
	
	$array1 = [
		['id' => 1, 'name' => 'John Doe'],
		['id' => 2, 'name' => 'Jane Doe'],
		['id' => 3, 'name' => 'Jack Doe']
	];
	
	$array2 = Arr::where($array1, function($key, $value) {
		return $value['id'] > 2;
	});
	
**Result:**

	$array2 = [
		2 => ['id' => 3, 'name' => 'Jack Doe']
	];
	
**Equivalent Helper Function:**

	array_where($array, callable $callback);
	
**Notes:**

Be careful because the returned arrays have elements that retain their keys from previous arrays.
