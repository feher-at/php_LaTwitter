<?php


namespace App\Services;

use App\Dao\Products\IProductsDao;
use App\Http\Models\ProductModel;
use App\Services\Interfaces\IProductService;
use Illuminate\Http\Request;


class ProductServiceImpl implements IProductService
{
    private IProductsDao $dao;

    public function __construct(IProductsDao $dao){
        $this->dao = $dao;
    }

    /**
     * @param Request $request
     * @param false $isAdmin
     * @return array
     */
    public function getProducts(Request $request, bool $isAdmin = false){
        $data = array();
        $ajaxRequest = $request->all();
        $searchValue = $ajaxRequest['search']['value'];
        $limit = $request  ->get('length');
        $offset = $request ->get('start') ;
        $searchValue === null ? $products= $this->dao->getProducts($limit,$offset)
                              : $products = $this->dao->searchProduct($searchValue,$limit,$offset);
        /**
         * @var ProductModel $product
         */
        foreach ($products as $product)
        {
            if (!$isAdmin) {
                $product->product_price = $product->product_sale_price ?? $product->product_price;
            }
            array_push($data,$product);
        }
        return $data;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function countProducts(Request $request){
        $ajaxRequest = $request->all();
        $searchValue = $ajaxRequest['search']['value'];
        return  $searchValue === null ? $this->dao->countProducts()[0]
                                      : $this->dao->countFilteredProducts($searchValue);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function selectProductById(Request $request){

        return $this->dao->selectProductById($request->query('id'));
    }

    /**
     * @param Request $request
     */
    public function deleteProduct(Request $request){

        if($request->ajax()){
            $this->dao->deleteProduct( $request->get('id'));
        };
    }

    public function checkIfProductExist($id){

        return $this->dao->checkIfProductExist($id)[0]->exists;
    }

    /**
     * @param Request $request
     */
    public function createNewItem(Request $request){
        $inputs = array_slice($request->input(),1,-1);
        $inputs['created_at'] = now();
        $inputs['updated_at'] = now();
        $product = new ProductModel;
        foreach($inputs as $key => $value)
        {
            $product->$key = $value;
        }
        $product->save();
    }

    /**
     * @param Request $request
     */
    public function updateTheItem( Request $request){
        $inputs = array_slice($request->input(),1);
        $updatingProduct = ProductModel::find($inputs['id']);
        foreach ($inputs as $key=>$value)
        {
            $updatingProduct->$key = $value;
        }
        $updatingProduct->save();
    }

    public function validation($request){
        return $request->validate([
            'product_name'        => 'required|max:255',
            'product_price'       => 'required|integer|min:0',
            'product_sale_price'  => 'integer|min:0|max:'. intval($request['product_price']),
            'product_description' => 'max:255',
        ]);
    }
}
