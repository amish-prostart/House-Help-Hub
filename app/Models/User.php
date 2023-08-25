<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class User extends Authenticatable implements HasMedia, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, InteractsWithMedia;

    const COLLECTION_PROFILE_PICTURES = 'profile_photo';

    const INACTIVE = 0;
    const ACTIVE = 1;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'category_id',
        'role',
        'phone',
        'gender',
        'address',
        'city',
        'state',
        'country',
        'is_active',
        'status',
        'old_price',
        'new_price',
        'work_description',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $with = ['media'];
    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'first_name'    => 'required',
        'last_name'     => 'required',
        'email'         => 'required|email:filter|unique:users,email',
        'password'      => 'nullable|same:password_confirmation|min:6',
        'role'          => 'required',
        'phone'         => 'required',
        'gender'        => 'required',
        'address'       => 'required',
        'city'          => 'required',
        'state'         => 'required',
        'country'       => 'required',
    ];

    const ROLES = [
        'Admin' => 'Admin',
        'Customer' => 'Customer',
        'Provider' => 'Provider',
    ];

    const FRONT_ROLES = [
        'Customer' => 'Customer',
        'Provider' => 'Provider',
    ];

    const BOOKING_TIMES = [
        '09:00 AM - 11:00 AM' => '09:00 AM - 11:00 AM',
        '11:00 AM - 01:00 PM' => '11:00 AM - 01:00 PM',
        '01:00 PM - 03:00 PM' => '01:00 PM - 03:00 PM',
        '03:00 PM - 05:00 PM' => '03:00 PM - 05:00 PM',
        '05:00 PM - 07:00 PM' => '05:00 PM - 07:00 PM',
        '07:00 PM - 09:00 PM' => '07:00 PM - 09:00 PM',
    ];

    protected $appends = ['full_name','image_url'];

    /**
     * @return string
     */
    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

    /**
     * @return mixed
     */
    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::COLLECTION_PROFILE_PICTURES)->first();
        if (! empty($media)) {
            return $media->getFullUrl();
        }

        return asset('assets/images/avatar.png');
    }

    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function booking(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
