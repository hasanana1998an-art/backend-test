<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [

            // ==============================
            // البائع 1 (user_id = 8) - Solar Panels
            // ==============================
            [
                'name' => 'Polycrystalline Solar Panel 300W',
                'description' => 'لوحة شمسية متعددة البلورات بقدرة 300 واط، مثالية للاستخدام المنزلي والمشاريع الصغيرة. توفر كفاءة عالية وطاقة مستقرة، مع تحمل درجات الحرارة العالية والأمطار. سهلة التركيب ومتوافقة مع أنظمة التحكم المختلفة.',
                'price' => 220,
                'category_id' => 1,
                'stock_quantity' => 50,
                'image_url' => 'images/products/solar_panel_300w.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Monocrystalline Solar Panel 350W',
                'description' => 'لوحة شمسية أحادية البلورة بقدرة 350 واط، توفر كفاءة عالية ومدة عمر طويلة. مناسبة للمنازل والمشاريع المتوسطة. مقاومة للعوامل الجوية مع ضمان أداء ثابت لفترة طويلة.',
                'price' => 280,
                'category_id' => 1,
                'stock_quantity' => 40,
                'image_url' => 'images/products/solar_panel_350w.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Flexible Solar Panel 100W',
                'description' => 'لوحة شمسية مرنة 100 واط، مثالية للاستخدام في القوارب والمركبات والمشاريع الصغيرة. تصميم خفيف ومرن يسمح بالتركيب على الأسطح المنحنية بسهولة. مقاومة للماء ومتانة عالية.',
                'price' => 120,
                'category_id' => 1,
                'stock_quantity' => 60,
                'image_url' => 'images/products/flexible_solar_100w.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Solar Panel 200W Kit',
                'description' => 'مجموعة لوحة شمسية بقدرة 200 واط، تأتي مع الألواح والكوابل الأساسية للتركيب الفوري. مثالية للمبتدئين والمشاريع الصغيرة. سهلة التركيب ومتوافقة مع أنظمة التحكم الشائعة.',
                'price' => 180,
                'category_id' => 1,
                'stock_quantity' => 45,
                'image_url' => 'images/products/solar_panel_200w_kit.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'High-Efficiency Solar Panel 400W',
                'description' => 'لوحة شمسية عالية الكفاءة بقدرة 400 واط، توفر أفضل إنتاج للطاقة للمنازل والمشاريع الكبيرة. مقاومة للغبار والماء مع تصميم متين وطويل العمر. مثالية للمشاريع التجارية.',
                'price' => 350,
                'category_id' => 1,
                'stock_quantity' => 30,
                'image_url' => 'images/products/high_eff_solar_400w.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Bifacial Solar Panel 330W',
                'description' => 'لوحة شمسية ثنائية الوجه بقدرة 330 واط، تستفيد من الضوء المنعكس من الخلف لزيادة الإنتاجية. مثالية للأسطح الكبيرة والمشاريع التجارية. عمر طويل وكفاءة ممتازة.',
                'price' => 310,
                'category_id' => 1,
                'stock_quantity' => 25,
                'image_url' => 'images/products/bifacial_solar_330w.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Thin-Film Solar Panel 150W',
                'description' => 'لوحة شمسية رقيقة 150 واط، مثالية للاستخدام في الأماكن المنحنية والأسطح المرنة. وزن خفيف وسهولة التركيب. أداء جيد في الإضاءة المنخفضة ودرجة حرارة عالية.',
                'price' => 100,
                'category_id' => 1,
                'stock_quantity' => 50,
                'image_url' => 'images/products/thin_film_solar_150w.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Solar Panel 250W Premium',
                'description' => 'لوحة شمسية متميزة بقدرة 250 واط، تقدم كفاءة عالية وجودة تصنيع ممتازة. مثالية للاستخدام المنزلي والمشاريع الصغيرة والمتوسطة. مقاومة للأمطار والحرارة.',
                'price' => 210,
                'category_id' => 1,
                'stock_quantity' => 35,
                'image_url' => 'images/products/solar_panel_250w_premium.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Solar Panel 320W Standard',
                'description' => 'لوحة شمسية بقدرة 320 واط، مناسبة للاستخدام المنزلي والمشاريع الصغيرة والمتوسطة. أداء مستقر وعمر طويل مع حماية ضد الظروف الجوية المتغيرة.',
                'price' => 260,
                'category_id' => 1,
                'stock_quantity' => 40,
                'image_url' => 'images/products/solar_panel_320w_standard.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Solar Panel 280W Compact',
                'description' => 'لوحة شمسية بقدرة 280 واط، تصميم مضغوط وسهل التركيب. مناسبة للشرفات والأسطح الصغيرة. توفر أداء مستقر وكفاءة جيدة مع حماية ضد العوامل الجوية.',
                'price' => 230,
                'category_id' => 1,
                'stock_quantity' => 45,
                'image_url' => 'images/products/solar_panel_280w_compact.jpg',
                'user_id' => 8,
                'is_active' => true,
            ],

            // ==============================
            // البائع 2 (user_id = 9) - Batteries, Charge Controllers, Mounting Structures
            // ==============================
            [
                'name' => 'Lithium-Ion 12V 100Ah Battery',
                'description' => 'بطارية ليثيوم أيون 12 فولت 100 أمبير/ساعة، مناسبة لأنظمة الطاقة الشمسية الصغيرة والمتوسطة. تقدم عمر طويل وكفاءة تفريغ عالية، مع حماية ذكية من الشحن الزائد والتفريغ العميق.',
                'price' => 250,
                'category_id' => 2,
                'stock_quantity' => 30,
                'image_url' => 'images/products/lithium_battery_12v100ah.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Lead-Acid 12V 150Ah Battery',
                'description' => 'بطارية حمضية 12 فولت 150 أمبير/ساعة، مناسبة لتخزين الطاقة الشمسية الاحتياطية. توفر طاقة مستقرة لفترات طويلة مع صيانة بسيطة، مثالية للمنازل والمشاريع الصغيرة.',
                'price' => 180,
                'category_id' => 2,
                'stock_quantity' => 25,
                'image_url' => 'images/products/leadacid_battery_12v150ah.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Lithium-Ion 24V 50Ah Battery',
                'description' => 'بطارية ليثيوم أيون 24 فولت 50 أمبير/ساعة، مثالية للأنظمة الصغيرة والمتوسطة، مع أداء مستقر وعمر طويل. تأتي مع حماية مدمجة ضد الشحن الزائد والتفريغ العميق، وتصميم مدمج وسهل التركيب.',
                'price' => 280,
                'category_id' => 2,
                'stock_quantity' => 20,
                'image_url' => 'images/products/lithium_battery_24v50ah.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'AGM 12V 120Ah Battery',
                'description' => 'بطارية AGM 12 فولت 120 أمبير/ساعة، توفر طاقة احتياطية عالية الكفاءة. مثالية للمنازل والمشاريع الصغيرة. صيانة منخفضة وأداء موثوق في جميع الظروف الجوية.',
                'price' => 200,
                'category_id' => 2,
                'stock_quantity' => 25,
                'image_url' => 'images/products/agm_battery_12v120ah.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'MPPT Charge Controller 30A',
                'description' => 'جهاز تحكم بالشحن MPPT بقدرة 30 أمبير، يدير الطاقة الشمسية بكفاءة عالية، يحمي البطاريات من الشحن الزائد والتفريغ العميق. يدعم أنظمة 12/24 فولت ويتميز بشاشة عرض ذكية لمراقبة الأداء.',
                'price' => 120,
                'category_id' => 4,
                'stock_quantity' => 15,
                'image_url' => 'images/products/mppt_controller_30a.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'MPPT Charge Controller 60A',
                'description' => 'جهاز تحكم بالشحن MPPT بقدرة 60 أمبير، مثالي للأنظمة المتوسطة والكبيرة. حماية شاملة للبطاريات، شاشة عرض واضحة لتتبع الأداء والطاقة.',
                'price' => 180,
                'category_id' => 4,
                'stock_quantity' => 10,
                'image_url' => 'images/products/mppt_controller_60a.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],

            // Mounting Structures
            [
                'name' => 'Aluminum Solar Mounting Structure',
                'description' => 'هيكل تركيب ألمنيوم للألواح الشمسية، مقاوم للصدأ وسهل التركيب على الأسطح. مناسب للأسطح الصغيرة والمتوسطة، يوفر ثباتاً ممتازاً للألواح.',
                'price' => 150,
                'category_id' => 5,
                'stock_quantity' => 20,
                'image_url' => 'images/products/aluminum_mount.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Steel Solar Mounting Structure',
                'description' => 'هيكل فولاذي قوي لتركيب الألواح الشمسية على الأسطح الكبيرة والمشاريع التجارية. مقاومة عالية للرياح والأمطار، تصميم آمن وطويل العمر.',
                'price' => 250,
                'category_id' => 5,
                'stock_quantity' => 15,
                'image_url' => 'images/products/steel_mount.jpg',
                'user_id' => 9,
                'is_active' => true,
            ],

            // ==============================
            // البائع 3 (user_id = 10) - Inverters, Lighting Systems, Smart Meters
            // ==============================
            [
                'name' => 'String Inverter 3kW',
                'description' => 'محول طاقة سلسلة 3 كيلوواط، مصمم لأنظمة الطاقة الشمسية المنزلية. يقدم كفاءة تحويل عالية وحماية متقدمة ضد التحميل الزائد والحرارة. متوافق مع معظم اللوحات الشمسية وأجهزة القياس الذكية.',
                'price' => 450,
                'category_id' => 3,
                'stock_quantity' => 15,
                'image_url' => 'images/products/string_inverter_3kw.jpg',
                'user_id' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Hybrid Inverter 5kW',
                'description' => 'محول هجين 5 كيلوواط، يدعم الشبكة والبطاريات. مثالي للمنازل والمشاريع المتوسطة لتوفير الطاقة المستمرة. يحتوي على واجهة ذكية لمراقبة الأداء والتحكم عن بعد.',
                'price' => 800,
                'category_id' => 3,
                'stock_quantity' => 10,
                'image_url' => 'images/products/hybrid_inverter_5kw.jpg',
                'user_id' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Off-Grid Inverter 2kW',
                'description' => 'محول طاقة مستقل بقدرة 2 كيلوواط، مناسب للأنظمة بدون شبكة كهربائية. كفاءة عالية، حماية من الحمل الزائد والتفريغ العميق، سهل التركيب والصيانة.',
                'price' => 400,
                'category_id' => 3,
                'stock_quantity' => 12,
                'image_url' => 'images/products/offgrid_inverter_2kw.jpg',
                'user_id' => 10,
                'is_active' => true,
            ],

            // Lighting Systems
            [
                'name' => 'LED Solar Street Light 40W',
                'description' => 'ضوء شارع شمسي LED بقدرة 40 واط، يوفر إضاءة فعالة للمناطق الخارجية مع بطارية مدمجة وشحن تلقائي بالطاقة الشمسية. تصميم متين ومقاوم للظروف الجوية.',
                'price' => 120,
                'category_id' => 7,
                'stock_quantity' => 30,
                'image_url' => 'images/products/led_street_light_40w.jpg',
                'user_id' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'LED Solar Flood Light 100W',
                'description' => 'كشاف شمسي LED بقدرة 100 واط، مناسب للملاعب والحدائق والمناطق الكبيرة. يوفر إضاءة متساوية مع بطارية طويلة العمر وشحن سريع.',
                'price' => 250,
                'category_id' => 7,
                'stock_quantity' => 20,
                'image_url' => 'images/products/led_flood_100w.jpg',
                'user_id' => 10,
                'is_active' => true,
            ],

            // Smart Meters
            [
                'name' => 'Smart Energy Meter 2-Phase',
                'description' => 'عداد طاقة ذكي ثنائي الطور، يمكن مراقبته وتحليل استهلاك الكهرباء عبر تطبيق الهاتف. يدعم الاتصال اللاسلكي ويوفر بيانات دقيقة لحساب فاتورة الطاقة بكفاءة.',
                'price' => 150,
                'category_id' => 8,
                'stock_quantity' => 25,
                'image_url' => 'images/products/smart_meter_2phase.jpg',
                'user_id' => 10,
                'is_active' => true,
            ],
            [
                'name' => 'Smart Energy Meter 3-Phase',
                'description' => 'عداد طاقة ذكي ثلاثي الطور، مناسب للمنازل الكبيرة والمشاريع التجارية. يوفر قياس دقيق للطاقة، تقارير يومية وأسبوعية، ويتيح التحكم عن بعد عبر تطبيق ذكي.',
                'price' => 220,
                'category_id' => 8,
                'stock_quantity' => 20,
                'image_url' => 'images/products/smart_meter_3phase.jpg',
                'user_id' => 10,
                'is_active' => true,
            ],

        ];

        // يمكن تكرار نفس النمط لبقية المنتجات لتصل إلى 60 منتجًا
        DB::table('products')->insert($products);
    }
}
