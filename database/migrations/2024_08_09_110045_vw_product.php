<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_product");
        DB::statement("
            CREATE OR REPLACE VIEW vw_product AS
            SELECT 
                pt.id,
                pt.plu,
                pt.name,
                pt.product_category_id,
                pc.name AS category_name,
                pt.active AS status_product,
                COUNT(pv.id) AS variant_count
            FROM product pt
            LEFT JOIN product_categories pc ON pc.id = pt.product_category_id
            LEFT JOIN product_variant pv ON pv.product_id = pt.id
            GROUP BY pt.id, pt.plu, pt.name, pt.product_category_id, pc.name, pt.active
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_product");
    }
};
