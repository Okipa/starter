<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models\Brickables{
/**
 * App\Models\Brickables\CarouselBrick
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $brickable_type
 * @property array $data
 * @property int|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Okipa\LaravelBrickables\Abstracts\Brickable $brickable
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brick ordered($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick whereBrickableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarouselBrick whereUpdatedAt($value)
 */
	class CarouselBrick extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models\Brickables{
/**
 * App\Models\Brickables\TwoTextImageColumnsBrick
 *
 * @property int $id
 * @property string $model_type
 * @property int $model_id
 * @property string $brickable_type
 * @property array $data
 * @property int|null $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Okipa\LaravelBrickables\Abstracts\Brickable $brickable
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $model
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Brick ordered($direction = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick query()
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick whereBrickableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick whereModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick whereModelType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TwoTextImageColumnsBrick whereUpdatedAt($value)
 */
	class TwoTextImageColumnsBrick extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models\LibraryMedia{
/**
 * App\Models\LibraryMedia\LibraryMediaCategory
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\LibraryMedia\LibraryMediaFile[] $files
 * @property-read int|null $files_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaCategory whereUpdatedAt($value)
 */
	class LibraryMediaCategory extends \Eloquent {}
}

namespace App\Models\LibraryMedia{
/**
 * App\Models\LibraryMedia\LibraryMediaFile
 *
 * @property int $id
 * @property int $category_id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\LibraryMedia\LibraryMediaCategory $category
 * @property-read string $icon
 * @property-read bool $is_displayable
 * @property-read array $translations
 * @property-read string $type
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LibraryMediaFile whereUpdatedAt($value)
 */
	class LibraryMediaFile extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models\Logs{
/**
 * App\Models\Logs\LogContactFormMessage
 *
 * @property int $id
 * @property array $data
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|LogContactFormMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogContactFormMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LogContactFormMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|LogContactFormMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogContactFormMessage whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogContactFormMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LogContactFormMessage whereUpdatedAt($value)
 */
	class LogContactFormMessage extends \Eloquent {}
}

namespace App\Models\News{
/**
 * App\Models\News\NewsArticle
 *
 * @property int $id
 * @property array $title
 * @property array $slug
 * @property array|null $description
 * @property bool $active
 * @property \Illuminate\Support\Carbon $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\News\NewsCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read array $category_ids
 * @property-read array $translations
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Metable\Meta[] $meta
 * @property-read int|null $meta_count
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMeta($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMetaNumeric($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereDoesntHaveMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMetaKeys($keys)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMeta($key, $operator, $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaIn($key, $values)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaNumeric($key, $operator, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsArticle whereUpdatedAt($value)
 */
	class NewsArticle extends \Eloquent implements \Spatie\Feed\Feedable {}
}

namespace App\Models\News{
/**
 * App\Models\News\NewsCategory
 *
 * @property int $id
 * @property array $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\News\NewsArticle[] $articles
 * @property-read int|null $articles_count
 * @property-read array $translations
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsCategory whereUpdatedAt($value)
 */
	class NewsCategory extends \Eloquent {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\Page
 *
 * @property int $id
 * @property string $unique_key
 * @property array $nav_title
 * @property array $slug
 * @property bool $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $translations
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Metable\Meta[] $meta
 * @property-read int|null $meta_count
 * @method static \Illuminate\Database\Eloquent\Builder|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMeta($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMetaNumeric($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereDoesntHaveMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMetaKeys($keys)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMeta($key, $operator, $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaIn($key, $values)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaNumeric($key, $operator, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereNavTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUniqueKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Page whereUpdatedAt($value)
 */
	class Page extends \Eloquent implements \Okipa\LaravelBrickables\Contracts\HasBrickables {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\PageContent
 *
 * @property int $id
 * @property string $unique_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Metable\Meta[] $meta
 * @property-read int|null $meta_count
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMeta($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMetaNumeric($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereDoesntHaveMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMetaKeys($keys)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMeta($key, $operator, $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaIn($key, $values)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaNumeric($key, $operator, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereUniqueKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PageContent whereUpdatedAt($value)
 */
	class PageContent extends \Eloquent implements \Okipa\LaravelBrickables\Contracts\HasBrickables {}
}

namespace App\Models\Pages{
/**
 * App\Models\Pages\TitleDescriptionPageContent
 *
 * @property int $id
 * @property string $unique_key
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Plank\Metable\Meta[] $meta
 * @property-read int|null $meta_count
 * @method static \Illuminate\Database\Eloquent\Builder|TitleDescriptionPageContent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TitleDescriptionPageContent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMeta($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable orderByMetaNumeric($key, $direction = 'asc', $strict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleDescriptionPageContent query()
 * @method static \Illuminate\Database\Eloquent\Builder|TitleDescriptionPageContent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereDoesntHaveMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMeta($key)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereHasMetaKeys($keys)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleDescriptionPageContent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMeta($key, $operator, $value = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaIn($key, $values)
 * @method static \Illuminate\Database\Eloquent\Builder|Metable whereMetaNumeric($key, $operator, $value)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleDescriptionPageContent whereUniqueKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TitleDescriptionPageContent whereUpdatedAt($value)
 */
	class TitleDescriptionPageContent extends \Eloquent {}
}

namespace App\Models\Settings{
/**
 * App\Models\Settings\Settings
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $phone_number
 * @property string|null $address
 * @property string|null $zip_code
 * @property string|null $city
 * @property string|null $facebook
 * @property string|null $twitter
 * @property string|null $instagram
 * @property string|null $youtube
 * @property string|null $google_tag_manager_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $full_postal_address
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings query()
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereFacebook($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereGoogleTagManagerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereInstagram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereTwitter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereYoutube($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Settings whereZipCode($value)
 */
	class Settings extends \Eloquent implements \Spatie\MediaLibrary\HasMedia {}
}

namespace App\Models\Users{
/**
 * App\Models\Users\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string|null $welcome_valid_until
 * @property string|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $name
 * @property-read \Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection|\Spatie\MediaLibrary\MediaCollections\Models\Media[] $media
 * @property-read int|null $media_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereWelcomeValidUntil($value)
 */
	class User extends \Eloquent implements \Spatie\MediaLibrary\HasMedia, \Illuminate\Contracts\Auth\MustVerifyEmail {}
}

