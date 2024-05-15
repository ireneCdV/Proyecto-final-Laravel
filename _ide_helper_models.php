<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Product> $products
 * @property-read int|null $products_count
 * @method static \Illuminate\Database\Eloquent\Builder|Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Cita
 *
 * @property int $id
 * @property string $fecha
 * @property string $hora
 * @property int $servicio_id
 * @property int $user_id
 * @property int $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Service|null $service
 * @property-read \App\Models\User|null $usuario
 * @method static \Illuminate\Database\Eloquent\Builder|Cita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cita query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereHora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereServicioId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cita whereUserId($value)
 */
	class Cita extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CrudAdmin
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CrudAdmin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudAdmin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudAdmin query()
 */
	class CrudAdmin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CrudCategory
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CrudCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudCategory query()
 */
	class CrudCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CrudCita
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CrudCita newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudCita newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudCita query()
 */
	class CrudCita extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CrudProduct
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CrudProduct newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudProduct newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudProduct query()
 */
	class CrudProduct extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CrudService
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CrudService newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudService newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CrudService query()
 */
	class CrudService extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Invoice
 *
 * @property int $id
 * @property int $num_invoice
 * @property \Illuminate\Support\Carbon|null $date
 * @property string $total
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $cliente
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Line> $line
 * @property-read int|null $line_count
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereNumInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice whereUserId($value)
 */
	class Invoice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Line
 *
 * @property int $id
 * @property int $amount
 * @property int $invoice_id
 * @property int $product_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Invoice|null $invoice
 * @property-read \App\Models\Product|null $product
 * @method static \Illuminate\Database\Eloquent\Builder|Line newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Line newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Line query()
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereInvoiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereUpdatedAt($value)
 */
	class Line extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Product
 *
 * @property int $id
 * @property string|null $image
 * @property string $name
 * @property string $description
 * @property string $price
 * @property int $stock
 * @property string $brand
 * @property int $category_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Category|null $category
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Line> $lines
 * @property-read int|null $lines_count
 * @method static \Illuminate\Database\Eloquent\Builder|Product newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Product query()
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereBrand($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereStock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Product whereUpdatedAt($value)
 */
	class Product extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Service
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Service whereUpdatedAt($value)
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $address
 * @property string $dni
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed $password
 * @property string|null $cod_admin
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cita> $citas
 * @property-read int|null $citas_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Invoice> $facturas
 * @property-read int|null $facturas_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCodAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereDni($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

