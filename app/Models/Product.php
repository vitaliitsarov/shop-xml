<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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

     /**
     * @var string
     */
    protected $primaryKey = self::COLUMN_ID;

    /**
     * @var string
     */

    protected $table = "products";

    protected $fillable = [
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
        self::COLUMN_STATUS         => 'boolean'
    ];

    public function category() {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return string
     */

    public function getTitle(): string
    {
        return (string) $this->getAttribute(self::COLUMN_TITLE);
    }

    /**
     * @return Product
     */
    public function seTitle($value): Product
    {
        return $this->setAttribute(self::COLUMN_TITLE, $value);
    }

    /**
     * @return int
     */

    public function getIdProvider(): int
    {
        return $this->getAttribute(self::COLUMN_ID_PROVIDER);
    }

    /**
     * @return Product
     */
    public function setIdProvider($value): Product
    {
        return $this->setAttribute(self::COLUMN_ID_PROVIDER, $value);
    }

    /**
     * @return
     */

    public function getNetto()
    {
        return $this->getAttribute(self::COLUMN_PRICE_NETTO);
    }

    /**
     * @return Product
     */
    public function setNetto($value): Product
    {
        return $this->setAttribute(self::COLUMN_PRICE_NETTO, $value);
    }

    /**
     * @return
     */

    public function getVat()
    {
        return $this->getAttribute(self::COLUMN_VAT);
    }

    /**
     * @return Product
     */
    public function setVat($value): Product
    {
        return $this->setAttribute(self::COLUMN_VAT, $value);
    }

    /**
     * @return
     */

    public function getBrutto()
    {
        return $this->getAttribute(self::COLUMN_PRICE_BRUTTO);
    }

    /**
     * @return Product
     */
    public function setBrutto($value): Product
    {
        return $this->setAttribute(self::COLUMN_PRICE_BRUTTO, $value);
    }

    /**
     * @return int
     */

    public function getStock(): int
    {
        return $this->getAttribute(self::COLUMN_STOCK);
    }

    /**
     * @return Product
     */
    public function setStock($value): Product
    {
        return $this->setAttribute(self::COLUMN_STOCK, $value);
    }

    /**
     * @return boolean
     */

    public function getStatus(): boolean
    {
        return $this->getAttribute(self::COLUMN_STATUS);
    }

    /**
     * @return Product
     */
    public function setStatus($value): Product
    {
        return $this->setAttribute(self::COLUMN_STATUS, $value);
    }

    /**
     * @return int
     */

    public function getBarcode(): int
    {
        return $this->getAttribute(self::COLUMN_BARCODE);
    }

    /**
     * @return Product
     */
    public function setBarcode($value): Product
    {
        return $this->setAttribute(self::COLUMN_BARCODE, $value);
    }

    /**
     * @return string
     */

    public function getOriginalUrl(): string
    {
        return $this->getAttribute(self::COLUMN_ORIGINAL_URL);
    }

    /**
     * @return Product
     */
    public function setOriginalUrl($value): Product
    {
        return $this->setAttribute(self::COLUMN_ORIGINAL_URL, $value);
    }

    /**
     * @return string
     */

    public function getDescription(): string
    {
        return $this->getAttribute(self::COLUMN_DESCRIPTION);
    }

    /**
     * @return Product
     */
    public function setDescription($value): Product
    {
        return $this->setAttribute(self::COLUMN_DESCRIPTION, $value);
    }

    /**
     * @return array
     */

    public function getImages(): array
    {
        return json_decode($this->getAttribute(self::COLUMN_IMAGES, true));
    }

    /**
     * @return Product
     */
    public function setImages($value): Product
    {
        return $this->setAttribute(self::COLUMN_IMAGES, json_encode($value));
    }

    /**
     * @return string
     */

    public function getMainImage(): string
    {
        return json_decode($this->getAttribute(self::COLUMN_IMAGES))[0];
    }
}
