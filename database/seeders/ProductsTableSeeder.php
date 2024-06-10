<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'id' => 1,
            'name' => 'Cafe latte',
            'image_path' => 'images/1716368205.jpg',
            'price' => 50000,
            'description' => 'Cà phê latte, gọi tắt là latte, là một loại thức uống có nguồn gốc từ nước Ý. Tại Scandinavie và Bắc Âu, tên gọi latte chỉ một loại đồ uống kết hợp giữa espresso và sữa, trong khi latte của người Pháp là sự kết hợp giữa espresso và sữa đánh (khuấy).
            Bên cạnh đó, nhiều phong cách của latte được biến thể như việc sử dụng cà phê mocha có hương vị sô cô la, hay một số loại đồ uống khác như matcha, trà gia vị Ấn Độ (masala chai), sữa hạnh nhân,… hoặc sữa đậu nành. Nhìn chung, latte là một loại đồ uống có thành phần chính là cà phê và sữa (được đánh).
            Ngoài ra, một điểm nổi bật khi nhắc đến latte chính là nghệ thuật vẽ trên ly latte. Hình vẽ được tạo ra bằng cách rót sữa (sau khi được gia nhiệt làm nóng sữa với phương pháp kỹ thuật steamed milk hoặc frothed milk).
            Người pha chế có thể khéo tay để tạo ra nhiều hình vẽ như hoa, trái tim, cây cỏ, khuôn mặt, con vật hoặc đồ vật.',
            'id_category' => 3,
            'discount' => 10,
            'amount' => 50,
            'promotional_price' => 45000
        ]);

        Product::create([
            'id' => 2,
            'name' => 'Cafe capuchino',
            'image_path' => 'images/1716368205.jpg',
            'price' => 50000,
            'description' => 'Cà phê Capuchino có nguồn gốc từ Ý, pha chế từ 3 thành phần chính là cà phê Espresso, sữa nóng và sữa sủi bọt với điểm đặc trưng là hình vẽ bọt sữa được vẽ thành hình chiếc lá, trái tim, lá dương sỉ, trang trí phía trên cùng.
            Bên cạnh đó, các Barista cũng có thể rắc thêm một ít bột quế hoặc bột cacao lên lớp bề mặt trước khi phục vụ để tăng thêm hương vị, sức hấp dẫn cho cốc cà phê.',
            'id_category' => 3,
            'discount' => 10,
            'amount' => 50,
            'promotional_price' => 45000
        ]);

        Product::create([
            'id' => 3,
            'name' => 'Cafe đen đá',
            'image_path' => 'images/1716368205.jpg',
            'price' => 50000,
            'description' => '“…Cà phê là một thứ đồ uống diệu kì, khi có thể nhanh chóng biến thành món đồ uống thường nhật của mỗi người dân Việt Nam…”',
            'id_category' => 3,
            'discount' => 50,
            'amount' => 50,
            'promotional_price' => 25000
        ]);

        Product::create([
            'id' => 4,
            'name' => 'Cafe expresso',
            'image_path' => 'images/1716368205.jpg',
            'price' => 50000,
            'description' => 'Espresso là một loại đồ uống có dung tích 25 – 35ml được pha chế từ 7 – 9 gam cà phê (14-18 gam cho double), nước sạch có nhiệt độ 90,5° – 96,1°C được ép ở áp suất 9 – 10 atm qua cà phê. Thời gian pha là 20 – 30 giây. Trong khi pha, cà phê Espresso sẽ có độ nhớt của mật ong ấm và đồ uống thu được sẽ có lớp crema vàng sẫm, bồng bềnh.',
            'id_category' => 3,
            'discount' => 20,
            'amount' => 50,
            'promotional_price' => 40000
        ]);

        Product::create([
            'id' => 5,
            'name' => 'Cafe trứng',
            'image_path' => 'images/1716368205.jpg',
            'price' => 50000,
            'description' => 'Cà phê trứng là một loại thức uống có nguồn gốc từ Việt Nam được làm từ cà phê (cà phê vối) với trứng gà (có nhỏ thêm mật ong) và sữa đặc có đường. "Cà phê Giảng" là quán cà phê lâu đời và nổi tiếng nhất Hà thành phục vụ thức uống này.',
            'id_category' => 3,
            'discount' => 20,
            'amount' => 50,
            'promotional_price' => 40000
        ]);
    }
}
