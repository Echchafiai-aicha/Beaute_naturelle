 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Créer orders d'abord (si elle n'existe pas encore)
        if (!Schema::hasTable('orders')) {
            Schema::create('orders', function (Blueprint $table) {
                $table->id();
                $table->string('customer_name', 150);
                $table->string('customer_email', 150);
                $table->string('customer_phone', 30);
                $table->string('address', 255);
                $table->string('city', 100);
                $table->text('notes')->nullable();
                $table->decimal('total_price', 10, 2);
                $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])
                      ->default('pending');
                $table->timestamps();
            });
        }

        // Ensuite créer order_items
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
        Schema::dropIfExists('orders');
    }
};