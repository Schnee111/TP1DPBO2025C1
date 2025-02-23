public class PetShop {
    private int id;            // ID
    private String name;       // Nama produk
    private String category;   // Kategori produk
    private double price;      // Harga 

    // Konstruktor default
    public PetShop() {
        this.id = 0;
        this.name = "";
        this.category = "";
        this.price = 0.0;
    }

    // Konstruktor dengan parameter untuk inisialisasi dengan nilai yang diberikan
    public PetShop(int id, String name, String category, double price) {
        this.id = id;
        this.name = name;
        this.category = category;
        this.price = price;
    }

    // Getter untuk ID produk
    public int getId() {
        return this.id;
    }

    // Setter untuk ID produk
    public void setId(int id) {
        this.id = id;
    }

    // Getter untuk nama produk
    public String getName() {
        return this.name;
    }

    // Setter untuk nama produk
    public void setName(String name) {
        this.name = name;
    }

    // Getter untuk kategori produk
    public String getCategory() {
        return this.category;
    }

    // Setter untuk kategori produk
    public void setCategory(String category) {
        this.category = category;
    }

    // Getter untuk harga produk
    public double getPrice() {
        return this.price;
    }

    // Setter untuk harga produk
    public void setPrice(double price) {
        this.price = price;
    }
}
