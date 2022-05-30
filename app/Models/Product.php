<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
    use SoftDeletes;

    const COLUMN_ID             = 'id';
    const COLUMN_TITLE          = 'title';
    const COLUMN_ID_PROVIDER    = 'id_provider';
    const COLUMN_PRICE_NETTO    = 'price_netto';
    const COLUMN_PRICE_BRUTTO   = 'price_brutto';
    const COLUMN_VAT            = 'vat';
    const COLUMN_STOCK          = 'stock';
    const COLUMN_STATUS         = 'status';
    const COLUMN_BARCODE        = 'barcode';
    const COLUMN_ORIGINAL_URL   = 'original_url';
    const COLUMN_DESCRIPTION    = 'description';
    const COLUMN_IMAGES         = 'images';
    const COLUMN_CATEGORY       = 'category';

    /**
     * @var string
     */
    protected $primaryKey = self::COLUMN_ID;

    /**
     * @var string
     */

    protected $table = "products";

    protected $fillable = [
        self::COLUMN_ID,
        self::COLUMN_TITLE,
        self::COLUMN_ID_PROVIDER,
        self::COLUMN_PRICE_NETTO,
        self::COLUMN_PRICE_BRUTTO,
        self::COLUMN_VAT,
        self::COLUMN_STOCK,
        self::COLUMN_STATUS,
        self::COLUMN_BARCODE,
        self::COLUMN_ORIGINAL_URL,
        self::COLUMN_DESCRIPTION,
        self::COLUMN_IMAGES
    ];

    protected $casts = [
        self::COLUMN_ID_PROVIDER    => 'integer',
        self::COLUMN_STATUS         => 'boolean',
        self::COLUMN_CATEGORY       => 'array',
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function getId(): int
    {
        return (int) $this->getAttribute(self::COLUMN_ID);
    }
    
    /**
     * getTitle
     *
     * @return string
     */
    public function getTitle(): string
    {
        return (string) $this->getAttribute(self::COLUMN_TITLE);
    }

    /**
     * setTitle
     *
     * @param  mixed $value
     * @return Product
     */
    public function setTitle($value): Product
    {
        return $this->setAttribute(self::COLUMN_TITLE, $value);
    }

    /**
     * getIdProvider
     *
     * @return int
     */
    public function getIdProvider(): int
    {
        return $this->getAttribute(self::COLUMN_ID_PROVIDER);
    }
    
    /**
     * setIdProvider
     *
     * @param  mixed $value
     * @return Product
     */
    public function setIdProvider($value): Product
    {
        return $this->setAttribute(self::COLUMN_ID_PROVIDER, $value);
    }

       
    /**
     * getNetto
     *
     * @return void
     */
    public function getNetto()
    {
        return $this->getAttribute(self::COLUMN_PRICE_NETTO);
    }
    
    /**
     * setNetto
     *
     * @param  mixed $value
     * @return Product
     */
    public function setNetto($value): Product
    {
        return $this->setAttribute(self::COLUMN_PRICE_NETTO, $value);
    }
    
    /**
     * getVat
     *
     * @return void
     */
    public function getVat()
    {
        return $this->getAttribute(self::COLUMN_VAT);
    }

    /**
     * setVat
     *
     * @param  mixed $value
     * @return Product
     */
    public function setVat($value): Product
    {
        return $this->setAttribute(self::COLUMN_VAT, $value);
    }
    
    /**
     * getBrutto
     *
     * @return void
     */
    public function getBrutto()
    {
        return $this->getAttribute(self::COLUMN_PRICE_BRUTTO);
    }
    
    /**
     * setBrutto
     *
     * @param  mixed $value
     * @return Product
     */
    public function setBrutto($value): Product
    {
        return $this->setAttribute(self::COLUMN_PRICE_BRUTTO, $value);
    }
    
    /**
     * getStock
     *
     * @return int
     */
    public function getStock(): int
    {
        return $this->getAttribute(self::COLUMN_STOCK);
    }
    
    /**
     * setStock
     *
     * @param  mixed $value
     * @return Product
     */
    public function setStock($value): Product
    {
        return $this->setAttribute(self::COLUMN_STOCK, $value);
    }
    
    /**
     * getStatus
     *
     * @return 
     */
    public function getStatus()
    {
        return $this->getAttribute(self::COLUMN_STATUS);
    }
    
    /**
     * setStatus
     *
     * @param  mixed $value
     * @return Product
     */
    public function setStatus($value): Product
    {
        return $this->setAttribute(self::COLUMN_STATUS, $value);
    }
    
    /**
     * getBarcode
     *
     * @return int
     */
    public function getBarcode(): int
    {
        return $this->getAttribute(self::COLUMN_BARCODE);
    }
    
    /**
     * setBarcode
     *
     * @param  mixed $value
     * @return Product
     */
    public function setBarcode($value): Product
    {
        return $this->setAttribute(self::COLUMN_BARCODE, $value);
    }

    /**
     * getOriginalUrl
     *
     * @return string
     */
    public function getOriginalUrl(): string
    {
        return $this->getAttribute(self::COLUMN_ORIGINAL_URL);
    }
    
    /**
     * setOriginalUrl
     *
     * @param  mixed $value
     * @return Product
     */
    public function setOriginalUrl($value): Product
    {
        return $this->setAttribute(self::COLUMN_ORIGINAL_URL, $value);
    }
    
    /**
     * getDescription
     *
     * @return string
     */
    public function getDescription(): string
    {
        return htmlspecialchars_decode($this->getAttribute(self::COLUMN_DESCRIPTION));
    }
    
    /**
     * setDescription
     *
     * @param  mixed $value
     * @return Product
     */
    public function setDescription($value): Product
    {
        return $this->setAttribute(self::COLUMN_DESCRIPTION, $value);
    }

    /**
     * getImages
     *
     * @return array
     */
    public function getImages(): array
    {
        return json_decode($this->getAttribute(self::COLUMN_IMAGES, true));
    }
    
    /**
     * setImages
     *
     * @param  mixed $value
     * @return Product
     */
    public function setImages($value): Product
    {
        return $this->setAttribute(self::COLUMN_IMAGES, json_encode($value));
    }
    
    /**
     * setCategory
     *
     * @param  mixed $value
     * @return Product
     */
    public function setCategory($value): Product
    {
        return $this->setAttribute(self::COLUMN_CATEGORY, $value);
    }

    /**
     * getCategory
     *
     * @return string
     */
    public function getCategory(): array
    {
        return $this->getAttribute(self::COLUMN_CATEGORY);
    }

    /**
     * getMainImage
     *
     * @return string
     */
    public function getMainImage(): string
    {
        return json_decode($this->getAttribute(self::COLUMN_IMAGES))[0];
    }
    
    /**
     * getSlug
     *
     * @param  mixed $value
     * @return string
     */
    public function getSlug($value): string
    {
        $slug = Str::slug($value, '-');
        return $slug;
    }
}
