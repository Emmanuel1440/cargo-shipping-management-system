<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Create the ENUM type if it doesn't exist
        DB::statement("
            DO $$
            BEGIN
                IF NOT EXISTS (SELECT 1 FROM pg_type WHERE typname = 'crews_role_enum') THEN
                    CREATE TYPE crews_role_enum AS ENUM ('Captain', 'First Mate', 'Engineer', 'Deckhand');
                END IF;
            END
            $$;
        ");

        // Add new value (just in case)
        DB::statement("ALTER TYPE crews_role_enum ADD VALUE IF NOT EXISTS 'Engineer'");
    }

    public function down(): void
    {
        // ENUM types cannot be dropped easily, so usually left alone in down()
    }
};
