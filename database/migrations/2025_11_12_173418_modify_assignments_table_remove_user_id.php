<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            // Проверяем существование колонок перед удалением
            if (Schema::hasColumn('assignments', 'user_id')) {
                $table->dropForeign(['user_id']);
            }
        });
        
        Schema::table('assignments', function (Blueprint $table) {
            $columnsToDrop = [];
            
            if (Schema::hasColumn('assignments', 'user_id')) {
                $columnsToDrop[] = 'user_id';
            }
            if (Schema::hasColumn('assignments', 'status')) {
                $columnsToDrop[] = 'status';
            }
            if (Schema::hasColumn('assignments', 'submitted_at')) {
                $columnsToDrop[] = 'submitted_at';
            }
            if (Schema::hasColumn('assignments', 'submission')) {
                $columnsToDrop[] = 'submission';
            }
            if (Schema::hasColumn('assignments', 'feedback')) {
                $columnsToDrop[] = 'feedback';
            }
            if (Schema::hasColumn('assignments', 'grade')) {
                $columnsToDrop[] = 'grade';
            }
            if (Schema::hasColumn('assignments', 'reviewed_by')) {
                $columnsToDrop[] = 'reviewed_by';
            }
            if (Schema::hasColumn('assignments', 'reviewed_at')) {
                $columnsToDrop[] = 'reviewed_at';
            }
            
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assignments', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('new');
            $table->timestamp('submitted_at')->nullable();
            $table->text('submission')->nullable();
            $table->text('feedback')->nullable();
            $table->integer('grade')->nullable();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('reviewed_at')->nullable();
        });
    }
};
