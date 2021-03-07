<?php

namespace App\Console\Commands;

use App\Http\Models\ProductModel;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class NameConcatenation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'NameConcatenation:name {--prefix=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Concatenate the name with the given parameter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        $products = ProductModel::cursor();
        $prefix = $this->option('prefix');
        $bar = $this->output->createProgressBar($products->count());

        foreach ($products as $product) {
            $product->product_name = $prefix === null ?
                $product->product_name . " " . $product->id : $product->product_name . $prefix;

            if (!$product->isDirty()) {
                continue;
            }

            $product->save();
            $bar->advance();
        }

        $bar->finish();

        /** @var Collection $products */
        /*$products = ProductModel::toBase()->get();

        $prefix = $this->option('prefix');
        $bar = $this->output->createProgressBar($products->count());

        foreach ($products->chunk(3000) as $productsChunk) {
            foreach ($productsChunk as $product) {
                $newProductName = $prefix === null ?
                    $product->product_name . " " . $product->id : $product->product_name . $prefix;
                DB::update("Update products set product_name = ? where id = ?",[$newProductName,$product->id]);





                $bar->advance();
            }
        }



        $bar->finish();*/
    }

}
