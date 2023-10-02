<?php
    include("../layout/header.php");
?>

<?php
	global $conn;
    $dieukienTrang="";
    $trang = 0;

    if (isset($_GET["trang"]))
        $trang = $_GET["trang"];
    if (isset($_GET["tensp"]))
        $dieukienTrang = $_GET["tensp"];

    if($_SERVER["REQUEST_METHOD"]=="POST") {
        $dieukienTrang=$_POST["tkTenSP"];
    }

        $where="WHERE TenSanPham LIKE '%" . $dieukienTrang . "%'";
        $laysp=phan_trang("*","sanpham",$where,6,$trang,"&tensp=".$dieukienTrang);

        $truyvan_laysp = $laysp;

        $layLoaiSP="SELECT * FROM loaisp";
        $truyvan_layLoaiSP=mysqli_query($conn,$layLoaiSP);
?>

        <!--start-breadcrumbs-->
        <div class="breadcrumbs">
            <div class="container">
                <div class="breadcrumbs-main">
                    <ol class="breadcrumb">
                        <li><a href="index.php">Trang Chủ</a></li>
                        <li class="active">Sản phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
        <!--end-breadcrumbs-->
        <!--start-product-->
        <div class="product">
            <div class="container">
                <div class="product-main">
                
                    <!--  phan danh sach san pham -->

                    <div class="col-md-9 p-left" id="loadSP">
                        <div class="clearfix"></div>
                        <?php
                        $i = 0;
                        while ($cot = mysqli_fetch_array($truyvan_laysp)) {
                            $i++;
                            ?>
                            <div class="product-one">
                                <div class="col-md-4 product-left single-left">
                                    <div class="p-one simpleCart_shelfItem">

                                        <a href="ChiTietSanPham.php?MaSP=<?php echo $cot["MaSanPham"]; ?>" >  <!-- link chi tiet san pham -->

                                            <img height="250" src="../images/HinhSP/<?php echo $cot["Anh"] ?>" alt=""/>

                                            <div class="mask mask1">
                                                <span>Xem chi tiết</span>
                                            </div>
                                        </a>
                                        <h4><?php echo $cot["TenSanPham"] ?></h4>

                                        <p><a class="item_add" href="#"><span
                                                    class=" item_price"> <?php echo GiaTien($cot["DonGia"]); ?> VND </span></a></p>
                                    </div>
                                </div>

                            </div>


                            <?php if ($i % 3 == 0) { ?>

                                <div class="clearfix"></div>

                            <?php
                            }
                        }
                        ?>
                        <div class="divtrang"></div>
                    </div>

                    <!-- phan danh muc -->
                    <div class="col-md-3 p-right single-right">
                        <h3>Loại sản phẩm</h3>
                        <ul class="product-categories">
                            <?php
							global $conn;
                            $layLoaiSP="SELECT * FROM loaisp";
                            $truyvan_layLoaiSP=mysqli_query($conn,$layLoaiSP);
                            while($cot=mysqli_fetch_array($truyvan_layLoaiSP))
                            {
                                ?>
                                <li><a href="DanhMucSanPham.php?loaisp=<?php echo $cot["MaLoaiSP"] ?>"><?php echo $cot["TenLoai"] ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        <h3>Giá</h3>
                        <ul class="product-categories p1">
                        <li><a href="DanhMucSanPham.php?gia=1000000">Dưới 1.000.000</a></li>
                        <li><a href="DanhMucSanPham.php?gia=2000000">Dưới 2.000.000</a></li>
                        <li><a href="DanhMucSanPham.php?gia=10000000">Dưới 10.000.000</a></li>
                        <li><a href="DanhMucSanPham.php?gia=10000000000">Dưới 10.000.000.000</a></li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        
        <!--end-product-->
        <script src="../script/jsNguoiDung/jsNguoiDung.js"></script>
        <script>
            $(document).ready(function () {
                <?php
                   echo  "$('.divtrang_".$trang."').addClass('divtrangactive')";
                ?>

                $('#timkiem').click(function(){
                    timkiem_sanpham($('#gia').val(),$('#loaisp').val());
                });
            });
        </script>

    <?php
include("../layout/footer.php");
?>

