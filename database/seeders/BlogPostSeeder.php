<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            [
                'title' => 'Cómo reducir tu huella de carbono con tecnología',
                'slug' => 'como-reducir-huella-carbono-con-tecnologia',
                'excerpt' => 'Pequeños cambios en tus hábitos tecnológicos pueden reducir significativamente tu impacto ambiental. Descubrí cómo.',
                'content' => '<h2>La tecnología y el medio ambiente</h2>
                <p>La industria tecnológica genera aproximadamente el 4% de las emisiones globales de carbono, similar a la de la aviación comercial. Sin embargo, con pequeños cambios en nuestros hábitos, podemos reducir este impacto.</p>
                <h3>1. Optá por dispositivos eficientes</h3>
                <p>Los equipos con certificación Energy Star consumen hasta un 50% menos de energía. Antes de comprar, verificá esta certificación.</p>
                <h3>2. Alargá la vida útil de tus dispositivos</h3>
                <p>Reparar en lugar de reemplazar es una de las acciones más efectivas. Cada año adicional de uso reduce el impacto ambiental del dispositivo.</p>
                <h3>3. Reciclá correctamente los electrónicos</h3>
                <p>Los residuos electrónicos crecen a un ritmo alarmante. Llevá tus dispositivos viejos a centros de reciclaje certificados.</p>
                <h3>4. Usá cargadores solares</h3>
                <p>Aprovechar energía renovable para cargar tus dispositivos reduce tu dependencia de la red eléctrica.</p>
                <p><strong>Conclusión:</strong> Pequeños cambios en nuestros hábitos tecnológicos pueden marcar una gran diferencia para el planeta. Comenzá hoy mismo.</p>',
                'author' => 'María González',
                'published_date' => '2026-05-01',
                'is_published' => true,
                'image' => '/images/blog/1783309083.jpg',
            ],
            [
                'title' => 'Tecnología sustentable para el hogar',
                'slug' => 'tecnologia-sustentable-para-el-hogar',
                'excerpt' => 'Transformá tu casa en un espacio eco-friendly con estos dispositivos inteligentes y de bajo consumo.',
                'content' => '<h2>El hogar del futuro es sustentable</h2>
                <p>Cada vez más dispositivos nos permiten reducir nuestro impacto ambiental mientras disfrutamos de la comodidad de la tecnología moderna.</p>
                <h3>Termostatos inteligentes</h3>
                <p>Dispositivos como Nest o Ecobee aprenden tus hábitos y ajustan la temperatura automáticamente, reduciendo el consumo energético hasta un 15% anual.</p>
                <h3>Iluminación LED con sensores</h3>
                <p>Las bombillas LED consumen un 75% menos energía que las tradicionales y duran 25 veces más. Combinadas con sensores de movimiento, el ahorro es aún mayor.</p>
                <h3>Electrodomésticos eficientes</h3>
                <p>Los electrodomésticos clase A+++ consumen hasta un 40% menos de energía. Al reemplazar tus equipos, verificá su clasificación energética.</p>
                <h3>Paneles solares domésticos</h3>
                <p>La inversión inicial en paneles solares se recupera en 5-7 años, y luego generás electricidad gratuita por 20-25 años.</p>
                <p><strong>Invertí en tecnología sustentable para tu hogar.</strong> No solo cuidás el planeta, también reducís tus facturas mensuales.</p>',
                'author' => 'Carlos Ruiz',
                'published_date' => '2026-05-05',
                'is_published' => true,
                'image' => '/images/blog/1783309764.jpg',
            ],
            [
                'title' => 'Beneficios de los productos reciclados en tecnología',
                'slug' => 'beneficios-productos-reciclados',
                'excerpt' => 'Los dispositivos fabricados con materiales reciclados tienen ventajas que van más allá de lo ambiental.',
                'content' => '<h2>La economía circular en la tecnología</h2>
                <p>La economía circular está transformando la industria tecnológica. Cada vez más empresas adoptan materiales reciclados en sus productos, y los beneficios son múltiples.</p>
                <h3>Beneficio ambiental</h3>
                <p>Usar plásticos reciclados reduce la extracción de petróleo en un 80% y las emisiones de CO2 en un 70%. Además, disminuye la cantidad de residuos que terminan en océanos y vertederos.</p>
                <h3>Beneficio económico</h3>
                <p>Los productos fabricados con materiales reciclados suelen ser más económicos porque las materias primas recicladas cuestan menos. Esto se traduce en mejores precios para los consumidores.</p>
                <h3>Beneficio social</h3>
                <p>La industria del reciclaje genera empleos locales y fomenta una economía más justa y sostenible.</p>
                <h3>Empresas líderes</h3>
                <p>Apple utiliza aluminio 100% reciclado en sus MacBooks, Dell tiene líneas completas de productos con plásticos recuperados del océano, y Fairphone es pionera en diseño modular y reparabilidad.</p>
                <p><strong>Elegir productos reciclados es elegir un futuro mejor.</strong></p>',
                'author' => 'Laura Fernández',
                'published_date' => '2026-05-08',
                'is_published' => true,
                'image' => '/images/blog/blog.png',
            ],
            [
                'title' => 'Caso de éxito: Cómo una empresa redujo su huella de carbono en un 60%',
                'slug' => 'caso-exito-huella-carbono-empresa',
                'excerpt' => 'Conoce la historia de una empresa tecnológica que logró reducir su huella de carbono en un 60% en solo 18 meses.',
                'content' => '<h2>Un caso real de transformación sustentable</h2>
                <p>TechGreen Solutions, una empresa de desarrollo de software con 200 empleados, decidió en 2024 emprender un camino hacia la sostenibilidad. Los resultados superaron todas las expectativas.</p>
                <h3>El desafío inicial</h3>
                <p>La empresa generaba 450 toneladas de CO2 al año, principalmente por el consumo energético de sus servidores y el transporte de sus empleados.</p>
                <h3>Las soluciones implementadas</h3>
                <ul>
                    <li><strong>Migración a la nube verde:</strong> Cambiaron a proveedores con energía 100% renovable, reduciendo un 40% su huella.</li>
                    <li><strong>Política de trabajo híbrido:</strong> Redujeron los desplazamientos en un 50%.</li>
                    <li><strong>Renovación de equipos:</strong> Reemplazaron servidores por modelos más eficientes, ahorrando un 30% de energía.</li>
                    <li><strong>Compensación de carbono:</strong> Invierten en proyectos de reforestación local.</li>
                </ul>
                <h3>Resultados</h3>
                <p>En 18 meses, lograron reducir su huella de carbono de 450 a 180 toneladas anuales (60% de reducción). Además, ahorraron $120,000 en costos energéticos.</p>
                <p><strong>Lección aprendida:</strong> La sustentabilidad no solo es buena para el planeta, también es rentable para los negocios.</p>',
                'author' => 'Sofía Torres',
                'published_date' => '2026-07-15',
                'is_published' => true,
                'image' => '/images/blog/1783309514.webp',
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}