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
        Schema::table('projects', function (Blueprint $table) {
            //aggiungo colonna type alla tabella projects dopo la colonna "title"
            $table->unsignedBigInteger('type_id')->nullable()->after('title');
        
            //aggiungo la relazione(foreign key)
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');//set null permette di mantenere il file senza type qualora il type venisse eliminato
        
            //versione abbreviata
            /* $table->foreignId('type_id')->after('title')->nullable()->onDelete('set null')->costrained()*/
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //elimino il vincolo
            $table->dropForeign('projects_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};
