# Interfaces as Feature Filters

### 1. What are Interfaces?
- Interfaces are contracts that classes must adhere to, ensuring consistency in their method implementations.
- Unlike abstract classes, interfaces contain only method signatures, enforcing a structure for different classes.
- Example: A `NewsletterProvider` interface with a `sendEmail()` method, ensuring all providers like **MailChimp** and **Postmark** implement the same functionality.

### 2. Using Interfaces as Feature Filters
- **Core Idea**: Interfaces can act as feature checks, ensuring that objects support certain functionalities.
- Example: Both `Comment` and `Post` classes share behavior related to the "like" feature.

```php
class Comment {
    public function like() {
        // Logic to like the comment
    }
    public function isLiked(): bool {
        return true;
    }
}
```

### 3. Encapsulation & Handling Actions
Instead of handling logic separately in each class, you can create an external PerformLike class to manage the like feature.

```php
    class PerformLike {
        public function handle($model) {
            if ($model->isLiked()) {
                return;
            }
            $model->like(); 
            echo "Liked the model.";
        }
    }
```
#### Advantages:

Encapsulates logic in a dedicated class.

Allows passing different objects (Comment, Post, etc.) for processing without modifying individual classes.

### 4. The Problem with Duck Typing
If an incompatible object (e.g., Thread) without the required methods is passed, it leads to fatal errors.

Solution: Enforce type safety with interfaces.

### 5. Enforcing Type Safety with Interfaces
Define an `interface` for objects that can be liked:

```php
    interface CanBeLiked {
        public function like();
        public function isLiked(): bool;
    }
```

Explicitly declare that classes `implement` this `interface`:

```php
    class Comment implements CanBeLiked
    {
        public function like()
        {
            echo 'Like the comment';
        }

        public function isLiked()
        {
            return true;
        }
    }
```
### 6. Improved Code Clarity
The `PerformLike` action class can now safely expect only objects `implementing CanBeLiked`:

```php
    class PerformLike {
        public function handle(CanBeLiked $model) {
            if ($model->isLiked()) {
                return;
            }
            $model->like();
            echo "Liked the model.";
        }
    }
```

#### Benefits:

Prevents accidental passing of incompatible objects.

Enhances code maintainability.

### 7. Summary & Final Thoughts
**Interfaces as Feature Filters:**

Enforce type safety for objects sharing common functionality.

Ensure reusability and structured object interactions.

**Key Takeaways:**

Use interfaces to prevent runtime errors.

Feature-based interfaces promote modular, scalable code.

Choose meaningful interface names (CanBeLiked, CanBePurchased, etc.) for clarity.

This structured approach leads to cleaner, more maintainable PHP applications using object-oriented principles. 🚀
