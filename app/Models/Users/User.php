<?php

namespace App\Models\Users;

use App\Notifications\InitializePassword;
use App\Notifications\ResetPassword;
use App\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use Spatie\WelcomeNotification\ReceivesWelcomeNotification;

class User extends Authenticatable implements
    HasMedia,
    MustVerifyEmail // todo : comment if this feature is not needed
{
    use Notifiable;
    use HasMediaTrait;
    use ReceivesWelcomeNotification;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Register the media collections.
     * @SuppressWarnings(PHPMD.UnusedLocalVariable)
     *
     * @return void
     */
    public function registerMediaCollections()
    {
        $this->addMediaCollection('avatar')
            ->acceptsMimeTypes(['image/jpeg', 'image/png'])
            ->singleFile()
            ->registerMediaConversions(function (Media $media = null) {
                $this->addMediaConversion('profile')
                    ->fit(Manipulations::FIT_CROP, 260, 350)
                    ->keepOriginalImageFormat();
            });
    }

    /**
     * Register the media conversions.
     *
     * @param \Spatie\MediaLibrary\Models\Media|null $media
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     *
     * @throws \Spatie\Image\Exceptions\InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->fit(Manipulations::FIT_CROP, 40, 40)
            ->keepOriginalImageFormat();
    }

    /**
     * @return string
     */
    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return string
     */
    public function getInitialsAttribute()
    {
        $cleanedFirstName = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $this->first_name);
        $cleanedLastName = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $this->last_name);

        return substr($cleanedFirstName, 0, 1) . substr($cleanedLastName, 0, 1);
    }

    /**
     * Send the password reset notification.
     *
     * @param string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Send the welcome notification for password initialization.
     *
     * @param \Carbon\Carbon $validUntil
     */
    public function sendWelcomeNotification(Carbon $validUntil)
    {
        $this->notify(new InitializePassword($validUntil));
    }
}
