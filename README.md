# eephplib
eephplib is still in early Alpha.

**Alpha Completion:**
- Include PHP Core Functions for: [Variables](https://www.php.net/manual/en/ref.var.php), [Strings](https://www.php.net/manual/en/ref.strings.php), [Arrays](https://www.php.net/manual/en/ref.array.php), & HTTP subclasses of [$_GET](https://www.php.net/manual/en/reserved.variables.get.php), [$_POST](https://www.php.net/manual/en/reserved.variables.post.php), [$_COOKIE](https://www.php.net/manual/en/reserved.variables.cookies.php), and [$_REQUEST](https://www.php.net/manual/en/reserved.variables.request.php).
- Include Skyfire Libraries

**Beta Completion:**
- _Decision:_ Throw exceptions for methods that return false or nullables.
- Include PHP Core Functions for: [Math](https://www.php.net/manual/en/book.math.php), [BC Math](https://www.php.net/manual/en/book.bc.php), [Filesystem](https://www.php.net/manual/en/book.filesystem.php), [Sessions](https://www.php.net/manual/en/ref.session.php), [Functions](https://www.php.net/manual/en/book.funchand.php), [Filtering & Character Type Checking](https://www.php.net/manual/en/book.ctype.php) _(Open for discussion)_
- Include Unit Testing

-----

## ArrayList
- first()
- last()
- firstKey()
- lastKey()
- differentValues()
- sameValues()

## Programmatic Principles
- Methods are CamcelCase
  - Therefore, all original snake-case functions are rewritten into CamcelCase Methods
- Method Paremters are lowercase and snake-case (following C, C++, and the PHP constant design)
- Methods will never return a NULL type
