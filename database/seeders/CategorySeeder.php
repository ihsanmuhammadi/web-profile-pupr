<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "Rumah Tidak Layak Huni",
                "description" => "Program Rumah Tidak Layak Huni (RTLH) merupakan upaya pemerintah daerah untuk meningkatkan kualitas hunian masyarakat yang masih tinggal di rumah dengan kondisi tidak memenuhi standar layak huni. Dinas PUPR Kubu Raya melaksanakan perbaikan dan peningkatan rumah warga melalui bantuan konstruksi, rehabilitasi bagian yang rusak, dan penataan kembali struktur bangunan agar lebih aman, sehat, dan layak ditinggali.\r\n\r\nProgram ini difokuskan pada keluarga berpenghasilan rendah serta kelompok rentan yang membutuhkan dukungan pemerintah. Dengan meningkatkan kondisi hunian, diharapkan tercipta lingkungan permukiman yang lebih sehat, tertata, dan mendukung kesejahteraan masyarakat.",
                "tujuan" => "Tujuan:\r\nMeningkatkan kualitas hunian warga yang tinggal di rumah tidak layak huni.\r\nMenyediakan tempat tinggal yang aman, sehat, dan memenuhi standar layak huni.\r\nMembantu keluarga berpenghasilan rendah serta kelompok rentan agar memiliki hunian yang lebih layak.\r\nMengurangi kawasan permukiman kumuh dan meningkatkan kualitas lingkungan.\r\nMendukung kesejahteraan masyarakat melalui peningkatan kondisi tempat tinggal.\r\nManfaat:\r\nMemberikan lingkungan tinggal yang lebih aman bagi keluarga kurang mampu.\r\nMengurangi risiko kesehatan akibat kondisi rumah yang tidak memenuhi standar.\r\nMeningkatkan kenyamanan dan kualitas hidup masyarakat.\r\nMendorong terciptanya permukiman yang lebih tertata, bersih, dan layak.\r\nMembantu mempercepat pengentasan kemiskinan dari sisi kebutuhan dasar hunian.",
                "contoh_program_1" => "Bantuan Rehabilitasi Rumah Tidak Layak Huni untuk Keluarga Berpenghasilan Rendah. Program perbaikan rumah bagi warga kurang mampu dengan kondisi bangunan rusak atau tidak memenuhi standar layak huni. Bantuan mencakup perbaikan dinding, lantai, atap, serta sanitasi dasar agar rumah menjadi aman dan sehat.",
                "contoh_program_2" => "Pembangunan Rumah Layak Huni Baru bagi Warga yang Rumahnya Tidak Dapat Diperbaiki. Pembangunan unit rumah baru bagi keluarga yang kondisi bangunannya sudah tidak memungkinkan untuk direhabilitasi. Program ini memberikan hunian yang memenuhi standar keselamatan dan kenyamanan.",
                "contoh_program_3" => "Penataan Lingkungan Permukiman Kumuh melalui Rehabilitasi RTLH Terpadu. Kegiatan perbaikan rumah warga dalam satu kawasan secara terpadu untuk mengurangi kawasan kumuh. Penanganan dilakukan bersamaan dengan perbaikan sarana lingkungan seperti jalan, drainase, dan sanitasi.",
            ],
            [
                "name" => "Jalan Lingkungan",
                "description" => "Program Jalan Lingkungan bertujuan meningkatkan kualitas aksesibilitas dan mobilitas masyarakat di kawasan permukiman. Dinas PUPR Kubu Raya melakukan pembangunan, peningkatan, dan perbaikan jalan lingkungan untuk mendukung aktivitas sehari-hari warga serta memperkuat konektivitas antar-fasilitas umum seperti sekolah, pasar, dan layanan kesehatan.\r\nKegiatan yang dilakukan meliputi perkerasan jalan, penanganan kerusakan, pembukaan akses baru, serta penataan jalur pada titik yang membutuhkan perbaikan. Seluruh pekerjaan dilaksanakan sesuai standar teknis dan mempertimbangkan kondisi wilayah agar hasilnya lebih aman, nyaman, dan berkelanjutan bagi masyarakat.",
                "tujuan" => "Tujuan:\r\nMeningkatkan aksesibilitas dan kelancaran mobilitas masyarakat di kawasan permukiman.\r\nMenyediakan jalur yang aman, nyaman, dan layak untuk mendukung aktivitas harian warga.\r\nMenghubungkan kawasan permukiman dengan fasilitas umum seperti sekolah, pasar, dan pusat layanan publik.\r\nMengurangi kawasan terisolir serta memperkuat konektivitas antarwilayah.\r\nMeningkatkan kualitas infrastruktur dasar untuk mendukung pertumbuhan sosial dan ekonomi masyarakat.\r\nManfaat:\r\nMempermudah pergerakan warga dalam bekerja, bersekolah, atau mengakses layanan publik.\r\nMeningkatkan keselamatan pengguna jalan dengan kondisi jalan yang lebih baik dan tertata.\r\nMendorong aktivitas ekonomi lokal melalui akses yang lebih cepat dan efisien.\r\nMenunjang perkembangan permukiman agar lebih tertata dan nyaman.\r\nMengurangi biaya perawatan kendaraan masyarakat karena kondisi jalan yang lebih baik.",
                "contoh_program_1" => "Peningkatan Perkerasan Jalan Lingkungan Berbasis Hotmix. Pekerjaan peningkatan jalan lingkungan yang sebelumnya masih berupa tanah atau lapisan kerikil menjadi perkerasan hotmix untuk meningkatkan kenyamanan, keselamatan, dan kelancaran mobilitas warga di kawasan permukiman.",
                "contoh_program_2" => "Rehabilitasi Jalan Lingkungan Rusak Sedang–Berat. Perbaikan struktur jalan yang mengalami kerusakan seperti retak, berlubang, atau penurunan badan jalan. Program ini dilakukan untuk menjaga umur infrastruktur dan memastikan akses warga tetap aman digunakan setiap hari.",
                "contoh_program_3" => "Pembangunan Akses Jalan Lingkungan Menuju Fasilitas Umum. Pembangunan akses baru dari kawasan permukiman menuju fasilitas publik seperti sekolah, pasar desa, puskesmas, dan kantor desa. Program ini bertujuan memperluas konektivitas sekaligus mendukung aktivitas sosial dan ekonomi masyarakat.",
            ],
            [
                "name" => "Drainase Lingkungan",
                "description" => "Program Drainase Lingkungan berfokus pada peningkatan sistem pengelolaan air di kawasan permukiman untuk mencegah genangan dan banjir. Dinas PUPR Kubu Raya melakukan pembangunan saluran baru, rehabilitasi saluran yang rusak atau tersumbat, serta normalisasi jaringan drainase agar aliran air tetap lancar, terutama saat musim hujan.\r\n\r\nUpaya ini dilakukan untuk menciptakan lingkungan yang lebih sehat, aman, dan tertata. Penanganan drainase yang baik juga mendukung umur infrastruktur jalan dan fasilitas publik lainnya agar tidak mudah rusak akibat genangan air.",
                "tujuan" => "Tujuan:\r\nMencegah terjadinya genangan dan banjir di kawasan permukiman.\r\nMenyediakan sistem aliran air yang tertata dan berfungsi dengan baik.\r\nMeningkatkan kualitas infrastruktur agar tidak mudah rusak akibat luapan air.\r\nMendukung pengelolaan lingkungan yang sehat dan aman bagi masyarakat.\r\nMenata jaringan drainase agar sesuai standar teknis dan kebutuhan wilayah.\r\nManfaat:\r\nMengurangi risiko kerusakan jalan dan fasilitas umum akibat genangan air.\r\nMenciptakan lingkungan permukiman yang lebih bersih, sehat, dan nyaman.\r\nMengurangi potensi penyebaran penyakit yang timbul akibat air tergenang.\r\nMenunjang aktivitas warga karena lingkungan bebas banjir lebih mudah dilalui.\r\nMeningkatkan ketahanan infrastruktur sehingga lebih awet dan efisien dalam perawatan.",
                "contoh_program_1" => "Pembangunan Saluran Drainase Baru di Kawasan Permukiman. Pembangunan saluran drainase baru pada wilayah yang belum memiliki jaringan pembuangan air, guna mencegah genangan dan mendukung pengelolaan air hujan secara terarah.",
                "contoh_program_2" => "Rehabilitasi dan Normalisasi Saluran Drainase Eksisting. Pembersihan, penggalian ulang, dan perbaikan saluran drainase yang mengalami pendangkalan, kerusakan, atau penyumbatan. Program ini memastikan aliran air tetap lancar terutama saat curah hujan tinggi.",
                "contoh_program_3" => "Peningkatan Kapasitas Drainase pada Titik Rawan Banjir. Pelebaran dan pendalaman saluran pada lokasi yang sering mengalami limpasan air, termasuk pemasangan tutup drainase dan talud penahan agar sistem drainase lebih optimal dan tahan terhadap beban aliran yang besar.",
            ],
            [
                "name" => "Jembatan Lingkungan",
                "description" => "Program Jembatan Lingkungan bertujuan menyediakan akses penghubung yang aman dan layak antar kawasan permukiman, terutama pada wilayah yang dipisahkan oleh sungai kecil, parit, atau aliran irigasi. Dinas PUPR Kubu Raya melakukan pembangunan jembatan baru, peningkatan struktur jembatan yang sudah ada, serta perbaikan komponen yang mengalami kerusakan demi menjaga kelancaran mobilitas warga.\r\nUpaya ini tidak hanya memperkuat konektivitas antar wilayah, tetapi juga mendukung aktivitas ekonomi dan sosial masyarakat. Dengan jembatan yang lebih kuat, aman, dan fungsional, kualitas hidup dan akses layanan publik di lingkungan permukiman dapat meningkat secara signifikan.",
                "tujuan" => "Tujuan:\r\nMenyediakan akses penghubung yang aman dan layak antar kawasan permukiman.\r\nMempermudah mobilitas warga pada wilayah yang dipisahkan sungai kecil, parit, atau saluran air.\r\nMeningkatkan konektivitas antarwilayah demi mendukung kegiatan sosial dan ekonomi.\r\r\nMengganti atau memperbaiki jembatan yang rusak agar lebih aman digunakan.\r\nMembangun infrastruktur penghubung yang sesuai standar konstruksi dan kebutuhan masyarakat.\r\nManfaat:\r\nMempercepat mobilitas harian warga karena akses antarwilayah menjadi lebih mudah.\r\nMendukung kegiatan ekonomi lokal, seperti distribusi barang dan aktivitas perdagangan.\r\nMeningkatkan keselamatan masyarakat dengan jembatan yang lebih kuat dan stabil.\r\nMenghubungkan permukiman dengan fasilitas umum seperti sekolah, pasar, dan pusat layanan publik.\r\nMengurangi keterisolasian wilayah tertentu, terutama pada musim hujan.",
                "contoh_program_1" => "Pembangunan Jembatan Lingkungan Penghubung Antar Permukiman. Pembangunan jembatan baru di kawasan permukiman yang dipisahkan oleh sungai kecil atau parit, untuk mempermudah mobilitas warga dan meningkatkan akses menuju fasilitas umum.",
                "contoh_program_2" => "Rehabilitasi Struktur Jembatan Lingkungan yang Mengalami Kerusakan. Perbaikan lantai jembatan, balok penyangga, dan pagar pengaman pada jembatan yang sudah aus atau rusak untuk memastikan keamanan dan kelayakan penggunaan sehari-hari.",
                "contoh_program_3" => "Peningkatan Jembatan Lingkungan dari Konstruksi Kayu ke Beton. Mengganti jembatan lama berbahan kayu yang sudah tidak layak menjadi jembatan beton yang lebih kuat, tahan lama, serta aman digunakan oleh kendaraan roda dua dan pejalan kaki.",
            ],
            [
                "name" => "Perumahan",
                "description" => "Program Perumahan berfokus pada penyediaan hunian yang layak, terjangkau, dan terencana bagi masyarakat di Kabupaten Kubu Raya. Dinas PUPR Kubu Raya melaksanakan berbagai kegiatan seperti pengembangan kawasan permukiman, peningkatan sarana dan prasarana dasar perumahan, serta penataan lingkungan agar lebih tertib dan aman.\r\nProgram ini juga mendukung upaya pemerintah daerah dalam mengurangi kawasan kumuh dan meningkatkan kualitas hidup masyarakat melalui penyediaan akses air bersih, jalan lingkungan, drainase, serta fasilitas pendukung lainnya. Dengan perumahan yang lebih terkelola, diharapkan tercipta lingkungan hunian yang sehat, nyaman, dan berkelanjutan.",
                "tujuan" => "Tujuan:\r\nMenyediakan hunian yang layak, aman, dan terjangkau bagi masyarakat.\r\nMengembangkan kawasan permukiman yang tertata dan sesuai rencana tata ruang daerah.\r\nMeningkatkan sarana dan prasarana dasar permukiman seperti jalan, drainase, dan air bersih.\r\nMengurangi kawasan kumuh melalui penataan lingkungan dan peningkatan kualitas infrastruktur.\r\nMendukung pertumbuhan wilayah dengan menyediakan lingkungan perumahan yang sehat dan berkelanjutan.\r\nManfaat:\r\nMeningkatkan kualitas hidup masyarakat melalui penyediaan hunian yang lebih baik.\r\nMenciptakan lingkungan permukiman yang lebih rapi, aman, dan nyaman.\r\nMemperkuat akses warga terhadap fasilitas umum dan layanan sosial.\r\nMengurangi kepadatan dan kawasan tidak tertata melalui penataan perumahan.\r\nMendukung perkembangan ekonomi lokal melalui kawasan hunian yang lebih terkelola.",
                "contoh_program_1" => "Pengembangan Kawasan Permukiman Baru yang Terencana. Program penyediaan kawasan perumahan baru dengan tata ruang yang jelas, dilengkapi sarana dasar seperti jalan lingkungan, drainase, dan ruang terbuka. Tujuannya adalah menyediakan hunian terjangkau bagi masyarakat dan mengurangi kepadatan di wilayah tertentu.",
                "contoh_program_2" => "Penataan dan Peningkatan Kualitas Lingkungan Perumahan Eksisting. Peningkatan sarana prasarana permukiman pada kawasan yang sudah berdiri, seperti perbaikan jalan lingkungan, drainase, sanitasi, dan penerangan. Program ini bertujuan menciptakan lingkungan hunian yang lebih sehat, rapi, dan nyaman.",
                "contoh_program_3" => "Pencegahan dan Penanganan Kawasan Kumuh Perkotaan. Program pengurangan kawasan kumuh melalui perbaikan fisik rumah, penataan akses jalan, penyediaan air bersih, dan peningkatan fasilitas umum. Kegiatan ini dilakukan untuk mendukung kualitas hidup masyarakat serta menjaga keteraturan permukiman.",
            ],
            [
                "name" => "Kawasan Kumuh",
                "description" => "Deskripsi kawasan kumuh",
                "tujuan" => "Tujuan dan manfaat kawasan kumuh",
                "contoh_program_1" => "Contoh Program Kawasan Kumuh 1",
                "contoh_program_2" => "Contoh Program Kawasan Kumuh 2",
                "contoh_program_3" => "Contoh Program Kawasan Kumuh 3",
            ],
        ];

        foreach ($data as $item) {
            Category::updateOrCreate( ['name' => $item['name']], $item );
        }
    }
}
