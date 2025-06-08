# Contact Form Partial Usage Guide

The contact form has been refactored into flexible, reusable partials that can be used across multiple pages with different layouts and configurations.

## Files Structure

- `resources/views/partials/contact-form.blade.php` - Main wrapper with layout options
- `resources/views/partials/contact-form-fields.blade.php` - Form fields and functionality

## Usage Examples

### 1. Default Layout (Full Contact Page)
```php
@include('partials.contact-form', [
    'layout' => 'default',
    'title' => __('Get in Touch'),
    'wrapperClass' => 'container',
    'showSubject' => true,
    'showCategory' => true,
    'messageRows' => '6'
])
```

### 2. Inline Layout (Index Page Section)
```php
@include('partials.contact-form', [
    'layout' => 'inline',
    'title' => __('Get in Touch'),
    'containerClass' => 'mt-md-45 mt-xxl-70',
    'showSubject' => true,
    'showCategory' => true,
    'messageRows' => '4'
])
```

### 3. Compact Layout with Toggle (Sidebar/Widget)
```php
@include('partials.contact-form', [
    'layout' => 'compact',
    'showToggle' => true,
    'title' => __('Quick Contact'),
    'subtitle' => __('Send us a message'),
    'showSubject' => false,
    'showCategory' => false,
    'messageRows' => '3'
])
```

## Configuration Options

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `layout` | string | 'default' | Layout type: 'default', 'inline', 'compact' |
| `showToggle` | boolean | false | Show toggle button (compact layout only) |
| `title` | string | __('Get in Touch') | Main title text |
| `subtitle` | string | __('Get in Touch with Us') | Subtitle for compact layout |
| `wrapperClass` | string | '' | CSS classes for wrapper div |
| `containerClass` | string | '' | CSS classes for container |
| `showSubject` | boolean | true | Show subject field |
| `showCategory` | boolean | true | Show category dropdown |
| `messageRows` | string | '4' | Number of rows for message textarea |
| `formId` | string | auto-generated | Unique form ID (auto-generated if not provided) |

## Layout Types

### Default Layout
- Responsive two-column design
- Best for dedicated contact pages
- Includes all fields (name, email, subject, category, message)
- Full-width on mobile, two columns on desktop

### Inline Layout  
- Designed for sections within pages
- Gray background container with rounded corners
- Ideal for homepage sections
- Responsive grid layout

### Compact Layout
- Single column, minimal design
- Optional collapsible toggle
- Perfect for sidebars or widgets
- Can hide subject/category for simplicity

## Features

- **AJAX Form Submission** - No page reload required
- **Real-time Validation** - Client and server-side validation
- **Loading States** - Visual feedback during submission
- **Success/Error Messages** - User-friendly notifications
- **Multilingual Support** - All text translatable
- **Unique Form IDs** - Multiple forms on same page supported
- **Responsive Design** - Works on all devices

## Integration Examples

### Replace Index Page Contact Form

**Before (index.blade.php lines 247-278):**
```php
<article class="box-7 mt-md-45 mt-xxl-70 wow fadeIn bg-gray-100" data-wow-delay=".05s">
    <!-- Contact form -->
    <form class="rd-form rd-mailform form-lg" method="POST" action="{{ route('contact.store') }}">
        <!-- form fields -->
    </form>
</article>
```

**After:**
```php
@include('partials.contact-form', [
    'layout' => 'inline',
    'title' => __('Get in Touch'),
    'containerClass' => 'wow fadeIn',
    'showSubject' => true,
    'showCategory' => true
])
```

### Add to Sidebar
```php
@include('partials.contact-form', [
    'layout' => 'compact',
    'showToggle' => true,
    'title' => __('Quick Contact'),
    'showSubject' => false,
    'showCategory' => false
])
```

### Footer Contact Form
```php
@include('partials.contact-form', [
    'layout' => 'compact',
    'showToggle' => false,
    'title' => false,
    'showSubject' => false,
    'showCategory' => false,
    'messageRows' => '2'
])
```

## Email Configuration

The contact form uses the `CONTACT_REPLAY_TIME` environment variable to set the promised response time in emails. Make sure this is configured in your `.env` file:

```env
CONTACT_REPLAY_TIME=2
```

## Admin Dashboard

Contact submissions appear in the admin dashboard at `/admin/contacts` with:
- Status tracking (new, read, replied, closed)
- Category filtering
- Quick action buttons
- Notification badges for new messages

## Styling

The form inherits your existing CSS classes and includes custom styles for:
- Alert messages (success/error)
- Loading animations
- Responsive layouts
- Consistent spacing

All styling is contained within the partial files for easy maintenance.