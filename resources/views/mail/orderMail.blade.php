<tr>
    <td>
        <div style="padding: 0 15px;">
            <div style="color: #333; font-family: 'Open Sans', sans-serif; font-weight: bold; font-size: 20px; padding: 20px 0; ">
                Kedves {{ $order->customer_name }}!
            </div>
                <div style="color: #333; padding-bottom: 20px;">
                    Még egyszer köszönjük, hogy a laWebshop.hu-n vásároltál.
                    Partnerünk feldolgozta
                    és félretette neked a rendelt termékeket!
                    A rendelés adatai:
                    <p>Név: {{$order->customer_name}} </p>
                    <p>Termék neve: {{$order->product_name}}</p>
                    <p>Ár: {{$order->product_price_at_order}} FT</p>
                    <p>Szállítási cím: {{$order->customer_shipping_address}}</p>
                    <p>Számlázási cím: {{$order->customer_billing_address}}</p>
                    <p>Mennyiség: {{$order->product_quantity}} db</p>
                    <p>Végső ár: {{$order->final_price}} FT</p>
                    További szép napot kívánunk Neked!
                </div>
        </div>
    </td>
</tr>

