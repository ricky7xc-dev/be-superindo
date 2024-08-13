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
        DB::statement("DROP VIEW IF EXISTS vw_invoice");
        DB::statement("
            CREATE OR REPLACE VIEW vw_invoice AS
            SELECT
                inv.code,
                inv.status,
                inv.first_name,
                inv.last_name,
                inv.address,
                inv.phone_number,
                inv.email,
                inv.payment_proof,
                inv.payment_method,
                inv.created_user,
                inv.created_date,
                inv.updated_user,
                inv.updated_date,
                inv.user_id,
                SUM(c.qty * CAST(pv.price AS NUMERIC)) AS total_amount
                FROM invoice inv
                LEFT JOIN cart c ON inv.id = c.invoice_id
                LEFT JOIN product_variant pv on c.product_variant_id = pv.id
                GROUP BY
                    inv.code,
                    inv.status,
                    inv.first_name,
                    inv.last_name,
                    inv.address,
                    inv.phone_number,
                    inv.email,
                    inv.payment_proof,
                    inv.payment_method,
                    inv.created_user,
                    inv.created_date,
                    inv.updated_user,
                inv.user_id,
                    inv.updated_date;
                    
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW IF EXISTS vw_invoice");
    }
};
