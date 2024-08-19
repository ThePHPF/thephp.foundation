---
title: 'State of Generics and Collections'
layout: post
tags:
  - news
author:
  - name: Arnaud Le Blanc
    url: https://github.com/arnaud-lb
  - name: Derick Rethans
    url: https://derickrethans.nl
  - name: Larry Garfield
    url: https://www.garfieldtech.com/
published_at: 19 August 2024
---

Generics have been on the list of wanted features for a long time by numerous PHP developers. The topic is often brought up in "What's New in PHP?" talks as well during Q&A.

In this article we will be exploring the different approaches, and what their current state is.

- [Full Reified generics](#full-reified-generics)
- [Collections](#collections)
- [Other alternatives](#other-alternatives)
  - [Static Analysis](#static-analysis)
  - [Erased Generic Type Declarations](#erased-generic-type-declarations)
  - [Fully Erased Type Declarations](#fully-erased-type-declarations)
- [Generic Arrays](#generic-arrays)
  - [Fluid Arrays](#fluid-arrays)
  - [Static Arrays](#static-arrays)
- [Conclusion](#conclusion)

# Full Reified generics

With generics you can define classes with placeholders for the types of their properties and methods. These can then be specified when instances of the class are created. This enables code reusability and type safety across different data types.  "Reified" generics are implementations where the generic type information is defined and carried through to runtime, allowing for runtime enforcement of generic requirements.

As PHP syntax, this could look like:

	class Entry<KeyType, ValueType>
	{
		public function __construct(protected KeyType $key, protected ValueType $value)
		{
		}

		public function getKey(): KeyType
		{
			return $this->key;
		}

		public function getValue(): ValueType
		{
			return $this->value;
		}
	}

	new Entry<int, BlogPost>("123", new BlogPost());

In the instantiated class, the generic type `KeyType` will be replaced with `int`, and each instance of `ValueType` with `BlogPost`, resulting in an object behaving like the following class definition:

	class IntBlogPostEntry
	{
		public function __construct(protected int $key, protected BlogPost $value)
		{
		}

		public function getKey(): int
		{
			return $this->key;
		}

		public function getValue(): BlogPost
		{
			return $this->value;
		}
	}

There have been a few attempts in the past to add this functionality to PHP as well. Nikita Popov attempted the [most comprehensive experimental implementation](https://github.com/PHPGenerics/php-generics-rfc/issues/45) in 2020/2021, following up on [a draft RFC](https://wiki.php.net/rfc/generics) from 2016, and a [reddit post](https://www.reddit.com/r/PHP/comments/j65968/comment/g83skiz/) summarizing the remaining challenges.

At the start of this year, under the auspices of the PHP Foundation, Arnaud Le Blanc [restarted this effort](https://github.com/arnaud-lb/php-src/pull/4), using Nikita's work as a starting point. Although many technical issues have been addressed, plenty of them are still unresolved.

A key challenge is type inference. The use of generics tends to increase code verbosity because it requires type arguments to be specified each time a generic type is referenced. This is demonstrated in the following PHP code snippet:

	function f(List<Entry<int,BlogPost>> $entries): Map<int, BlogPost>
	{
		return new Map<int, BlogPost>($entries);
	}

	function g(List<BlogPostId> $ids): List<BlogPost>
	{
		return map<int, BlogPostId, BlogPost>($ids, $repository->find(...));
	}

Type inference can reduce this verbosity by letting the compiler deduce the appropriate types automatically for us. For instance, in the examples above, the compiler might automatically determine the correct types for `new Map()` and `map()`. However, this is hard in PHP. Quoting Nikita, "primarily due to the very limited view of the codebase the PHP compiler has (it only sees one file at a time)".

Consider the following example:

	class Box<T>
	{
		public function __construct(public T $value) {}
	}

	new Box(getValue());

In this scenario, the type of the getValue() expression is unknown until the function is loaded at runtime, making it impossible to infer `T` in `new Box(...)` during compilation.

We could assign `T` at runtime based on the return *value* of the function, but this would result in unstable typing. In the previous example the type of `new Box()` would depend on the *implementation* of the return value of `getValue()`, which may be too specific: combine that with the fact that Box is invariant, and this code would break very quickly when trying to do anything useful with the Box instance:

	interface ValueInterface {}
	class A implements ValueInterface {}
	class B implements ValueInterface {}

	function getValue(): ValueInterface
	{
		return new A();
	}

	function doSomething(Box<ValueInterface> $box)
	{
	}

	$box = new Box(getValue()) // runtime: Box<A>, statically: Box<ValueInterface>
	doSomething($box); // accepts Box<ValueInterface>, not Box<A>

Typing is most useful when it’s based on compile-time / static information that doesn’t depend on the implementation.

Note: In this example, `Box` is invariant, as it is often the case of generic classes. This means that `Box<X>` is neither a sub-type or a super-type of `Box<Y>` regardless of the relationship between `X` and `Y`, so `Box<A>` is not a sub-type of `Box<ValueInterface>`, and `doSomething()` can not accept a `Box<A>`.

A generic class is invariant when one of its type placeholders is used both in read (e.g. as a return type) and write (e.g. a parameter type) positions at the same time. A property type is both in read and write position.

To understand why, consider the following example:

	function changeValue(Box<ValueInterface> $box)
	{
		$box->value = new B();
	}

The `changeValue()` function accepts a `Box<ValueInterface>`, thus should be able to assign any sub-type of `ValueInterface` to `$box->value`. However, if we pass a `Box<A>` (with `A` a sub-type of `ValueInterface`), this contract breaks when we assign a value that is a sub-type of `ValueInterface` but not of `A`.

The common solution in other generic languages is to allow a type parameter to be marked variant in only one direction (typically "in" or "out"), provided it is used only in a parameter or return position, respectively.  That allows that type parameter to be contravariant or covariant, as appropriate.

### Hybrid Approach to Type Inference

To address these challenges, we explored a hybrid approach, that lets us implement static type inference of generic parameters without having the full information available at compile time. This approach represents unknown types as symbols at compile time (e.g. the type of the expression `getValue()` is represented as `fcall<getValue>`). Symbolic types can be resolved at runtime when needed after functions and classes have been loaded, at a fraction of the cost of running the entire analysis at runtime. This operation can be cached (in inline caches) for the duration of the request, and maybe in caches similar to the inheritance cache.

A proof of concept was implemented, and used to implement data-flow based, local, unidirectional type inference of generic type parameters, with the same behaviour as PHPStan/Psalm. The approach works, and could be used to experiment with other flavours of type inference.

### Performance Considerations

Another concern with generics is their impact on performance. Preliminary benchmarks indicated:

- Generics do not affect the performance of non-generic code.
- Simple generic code shows a modest performance degradation of about 1-2% compared to specialized code.

However, later exploration has shown that compound types (such as unions) can lead to super-linear time complexity in type checking, potentially resulting in more substantial performance drawbacks. For example, checking whether `A|B` accepts `B` is linear, but checking `Box<A|B>()` against `Box<A|B>()` is O(nm).

Super-linear complexity is also reached when merging compound types during the resolution of symbolic types.

### Future Directions

Ongoing challenges for reified generics include:

- Evaluating the effects of compound types and extreme cases
- Implement type-checking inline caches, and research more sophisticated algorithms for checking compound types
- Exploring eager-autoloading (preloading, but automatic), or inheritance-cache alike, to reduce the amount of symbolic types

# Collections

One of the main use cases for generics that often gets brought up is the need for typed arrays. In PHP, the swiss-army knife array type can be used (and abused) for lots of reasons. But you can't currently enforce the types to be used as key or value.

In a parallel project, we have been working on a dedicated Collections syntax as a less-challenging alternative to full generics.

Collections would come in three flavours: sets, sequences, and dictionaries. Sets and Sequences only define a value type, whereas Dictionaries have key and value types. The syntax of these could be as follows:

	class Article
	{
		public function __construct(public string $subject) {}
	}

	collection(Seq) Articles<Article>
	{
	}

	collection(Dict) YearBooks<int => Book>
	{
	}

You can then instantiate sequences and collections like you would do with a normal class:

	$a1 = new Articles();
	$b1 = new YearBooks();

Sequences and Dictionaries will automatically have [many methods defined](https://github.com/php/php-src/compare/master...derickr:php-src:collections\#diff-eeb1e0848e9a25b7492398bf5ddf9be15995a67d44a23c336869bf9f36910d1b) on them, providing a base functionality like PHP already has with the myriad of `array_*` functions. If you use the defined methods to add or update elements in the collection, then the type for keys and values have to match the ones as defined on the collection.

In the example above, the `add()` method for the YearBooks dictionary then requires int to be used as key, and Book as value. For the main manipulation methods (add, get, unset, and isset), ArrayAccess style overloaded operations will also work, as well as potentially operator overloads.

One of the drawbacks of Collections is that you need to declare them. Following adopted practise, that would mean a single line declaration in a separate file for each collection.

Another concern is potentially higher memory usage, as for each class PHP will have to keep a corresponding class entry, including a list of all the associated methods.

And a third concern is that there is no instanceof/is-a relationship between collections of compatible types, for example:

	class A {}
	class B extends A {}

	seq As<A> {}
	seq Bs<B> {}

	new B() instanceof A // true
	new Bs() instanceof As // false

Or:

	namespace Foo;
	seq As<A> {}

	namespace Bar;
	seq As<A> {}

	namespace;
	new Foo\As instanceof Bar\As; // false

Collections, although less powerful, can be an alternative to generics in many use cases, but without much of the complexity. The implementation as outline above is also significantly easier. An [experimental branch is also available](https://github.com/derickr/php-src/tree/collections).  However, if full generics are found to be viable and supported, implementing Seq, Set, and Dict directly on standard generics would be significantly preferable.

Larry Garfield has [conducted research](https://github.com/Crell/php-rfcs/blob/master/collections/research-notes.md) into other languages and how expansive their collection APIs are.  It's still in rough form, but the consensus seems to be "include everything", possibly broken up into discrete interfaces.  The rough recommendations at the end of the document suggest a likely way forward.

You can find a patch for collections at [https://github.com/php/php-src/pull/15429](https://github.com/php/php-src/pull/15429)

# Other alternatives

## Static Analysis

Recent years have seen the emergence of static analysers. Both [PHPStan](https://phpstan.org/blog/generics-in-php-using-phpdocs) and [Psalm](https://psalm.dev/docs/annotating_code/templated_annotations/) support generics via doc block annotations, and are frequently used in open source libraries and private projects.

Here is an example of a generic Dict class when using PHPStan and Psalm:

	/**
	 * @template Key
	 * @template Value
	 */
	class Dict
	{
		/**
		 * @param array<Key,Value> $entries
		 */
		public function __construct(private array $entries) {}

		/**
		 * @param Key $key
		 * @param Value $value
		 */
		public function set($key, $value): self
		{
			$this->entries[$key] = $value;
			return $this;
		}
	}

	/** @param Dict<string,string> $dict */
	function f($dict) {}

	$dict = new Dict([1 => 'foo']);
	$dict->set("foo", "bar"); // Static analyser error
	$dict->set(1, "bar");     // Ok
	f($dict);                 // Static analyser error

The docblock annotations are named “template” for historical reasons, but they implement a generics flavour very close to Java’s: Generic types are checked at static analysis time, and are not visible at runtime.

This offers some benefits of generics, such as type safety, with the following drawbacks:

- Docblocks can be verbose
- Type checking requires running a separate tool (like PHPStan or Psalm)
- Generic type information is entirely unavailable at runtime.
- Generic type information is not enforced at runtime (so if you don't run a static analysis tool in advance, they accomplish nothing).

## Erased Generic Type Declarations

Seeing the difficulties with implementing reified generics in PHP core, it has been proposed to implement them only syntactically, leaving the task of type checking to static analysers.

In this alternative, the PHP syntax would be changed so that type declarations, class declarations, and function declarations accept generic syntax, but the PHP engine would not check them.

We can call these “Erased” type declarations because the engine will simply ignore them at runtime. This alternative could be implemented in various ways:

- As part of php-src
- In an extension
- In an autoloader
- etc

Here is what the same Dict class as above would look like:

	class Dict<Key,Value>
	{
		public function __construct(private array<Key,Value> $entries) {}

		public function set(Key $key, Value $value): self
		{
			$this->entries[$key] = $value;
			return $this;
		}
	}

	function f(Dict<Key,Value> $dict) {}

	$dict = new Dict([1 => 'foo']);
	$dict->set("foo", "bar"); // Static analyser error
	$dict->set(1, "bar");     // Ok
	f($dict);                 // Static analyser error

This addresses the docblock verbosity issue of the Static Analysis alternative, but this introduces an inconsistency: Type declarations cause coercion, but erased generic type declarations will not.

Consider the following example:

	class StringList
	{
		public function add(string $value)
		{
			$this->values[] = $value;
		}
	}

	class List<T>
	{
		public function add(T $value)
		{
			$this->values[] = $value;
		}
	}

	$list = new StringList();
	$list->add(123); // coerced to string

	$list = new List<string>();
	$list->add(123); // NOT coerced to string

In this scenario, the first call to `add()` will coerce the argument to string, but not the second one.

In languages like Java, which has erased generics on top of a traditional type system, the compiler does type checking, so inconsistencies like the above do not exist. However, in PHP these are unavoidable.

Another drawback of erased generics is they are not visible at runtime. This would prevent pattern matching from seeing generic type arguments, for example.

## Fully Erased Type Declarations

One way to address the inconsistency issue of Erased Generics is to change all type declarations to be erased. This could be opt-in with a `declare()` statement:

	declare(types=erased);

In this alternative, the engine would stop checking types at runtime. In the previous example, both calls to `add()` would have the same behaviour: the value is not coerced. It is then up to the user to check types with an analyser.

This is not uncommon in mainstream interpreted languages, as all of Javascript (via TypeScript), Python, and Ruby have fully erased type declarations.

# Generic Arrays

This blog post discusses generic objects, but what about arrays?

## Fluid Arrays

Arrays are copy on write: Modifying them creates a new copy (if they are referenced elsewhere), and modifies the copy instead. This makes arrays safe to pass around as you don’t need to worry about other functions modifying them (unless passed by reference).

From a typing perspective this means that the type of an array is always defined by its content, and this type can not change because modifying an array creates a new one.

From a generics perspective this is a very convenient property, as this makes arrays variant: They can have supertypes and subtypes, just like any (non-generic) class. In other words, the following code is type safe:

	class A {}
	class B extends A {}

	function f(array $a) {}
	function g(array<A> $a) {}
	function h(array<B> $a) {}

	$array = [new B()];

	f($array);
	g($array);
	h($array);

Usually, generic containers are invariant because their type placeholders are used in both read and write positions. This is not the case for arrays because they are semantically immutable / copy on write.

So the natural way to implement generic arrays is just as explained above: Let their content define their type. This is illustrated in the example below:

	$a = [1];       // array<int>
	$b = [new A()]; // array<A>
	$c = $b;        // array<A>
	$c[] = new B(); // array<A|B>
	$b;             // array<A>

This does provide type safety, because what matters is that types are checked at API boundaries—when passing arguments to functions, returning values, updating object properties:

	function f(array<int> $a) {}

	$a = [1];
	f($a); // ok

	$b = [new A()];
	f($b); // error

A PoC has been implemented, but the performance impact is still uncertain. Another issue is that supporting references and/or typed properties may not be possible.

## Static Arrays

An alternative to Fluid Arrays is to fix the type at instantiation time:

	$a = array<int>(1); // array<int>
	$a[] = new A();     // error

However, this alternative is very orthogonal to how arrays are used in PHP code today. It also makes arrays invariant:

	function f(array<int> $a) {}
	function g(array $a) {}

	$a = [1];

	f($a); // ok
	g($a); // error

To understand why `g($a)` is an error, remember the explanation about invariance in the Generics section. `g()` accepts an `array` (`array<mixed>`), which means it should be able to add an element of any type to it. However, if we pass an `array<int>` to it, this contract is broken. Therefore, `array` can not accept `array<int>`.

Invariance would make arrays very difficult to adopt, as a library can not start type hinting generic arrays without breaking user code, and users can not pass generic arrays to libraries until they start using generic arrays type declarations.

These pitfalls are why it may also be preferable to focus on object-based collections Either with the custom syntax above described as Collections, or with the more complete full generics, as are present in most modern languages.  However, the two approaches are mutually-compatible.

# Conclusion

We hope to have explained in this article what different options are available for the implementation of generic objects, collections, or related features into PHP. More work is required, and ongoing, to determine which options are most desireable, or even feasible.

The next steps for investigation are:

* Further investigate type inference for reified generics.  If that turns out to be feasible with acceptable trade-offs, that is most likely the best option, and would imply building collections on top of them.
* Determine if erased generics would have any additional drawbacks not noted here that would make them infeasible.
* Determine if fully-erased types would have additional drawbacks not noted here that would make them infeasible.
* Further develop an optimal feature set for collections, which would be applicable either in the dedicated syntax or as an application of generics (reified or erased).
* Investigate the feasibility of using internal data structures in collections other than a hashmap (array) for better performance and simplicity.  (This would be a reason collections could not be done fully in user-space.)
* Halt efforts on typed arrays, as our current thoughts are that it is probably not worth doing, due to the complexities of how arrays work, and the minimal functionality that it would bring.

At this time, we are looking for specific feedback on *these questions only*, which will help guide our work going forward.  (Please, no feature requests not noted here.)

* If reified generics turn out to be infeasible, would erased generics be acceptable, or should that continue to be left to user-space tooling?
* What generic features are acceptable to leave out to make the implementation more feasible?  (Eg, don't allow generics over union types; unioned generics are slow and we don't care; don't support in/out variance markers; etc.)
* If erased generics are included, would that necessitate an official linter to validate them, or continue to leave that to user-space tooling?
* If reified generics turn out to be infeasible, would the dedicated collections syntax shown here be acceptable?
* Would "erased generics now, and we can *probably* convert them to reified in the future" be an acceptable strategy, if it is determined to be feasible?
