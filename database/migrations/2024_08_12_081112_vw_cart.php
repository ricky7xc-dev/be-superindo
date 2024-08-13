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
        DB::statement("DROP VIEW IF EXISTS vw_cart");
        DB::statement("DROP VIEW IF EXISTS vw_cart_checkout");
        DB::statement("
            CREATE OR REPLACE VIEW vw_cart AS
            SELECT
                cart.user_id,
                cart.product_variant_id,
                pv.name,
                pv.price,
                SUM(cart.qty) AS total_quantity,
                SUM(cart.qty * CAST(pv.price AS NUMERIC)) AS total_amount,
                cart.status
            FROM
                cart
            LEFT JOIN product_variant pv ON pv.id = cart.product_variant_id
            WHERE
                cart.status = 'cart'
            GROUP BY
                cart.user_id,
                cart.product_variant_id,
                pv.name,
                pv.price,
                cart.status;
        ");

        DB::statement("
            CREATE OR REPLACE VIEW vw_cart_checkout AS
            SELECT
                cart.user_id,
                cart.product_variant_id,
                pv.name,
                pv.price,
                SUM(cart.qty) AS total_quantity,
                SUM(cart.qty * CAST(pv.price AS NUMERIC)) AS total_amount,
                cart.status
            FROM
                cart
            LEFT JOIN product_variant pv ON pv.id = cart.product_variant_id
            WHERE
                cart.status = 'checkout'
            GROUP BY
                cart.user_id,
                cart.product_variant_id,
                pv.name,
                pv.price,
                cart.status;
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_cart");
        DB::statement("DROP VIEW IF EXISTS vw_cart_checkout");
    }
};
