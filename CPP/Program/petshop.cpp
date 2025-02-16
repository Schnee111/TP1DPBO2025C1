#include <iostream>
#include <string>

using namespace std;

// Kelas petshop
class petshop{
    private:
        int id;            // ID
        string name;       // Nama produk
        string category;   // Kategori produk
        double price;      // Harga 

    public:
        // Konstruktor default
        petshop() {
            this->id = 0;
            this->name = "";
            this->category = "";
            this->price = 0.0;
        }

        // Konstruktor dengan parameter untuk inisialisasi dengan nilai yang diberikan
        petshop(int id, string name, string category, double price) {
            this->id = id;
            this->name = name;
            this->category = category;
            this->price = price;
        }

        // Getter untuk ID produk
        int get_id() {
            return this->id;
        }

        // Setter untuk ID produk
        void set_id(int id) {
            this->id = id;
        }

        // Getter untuk nama produk
        string get_name() {
            return this->name;
        }

        // Setter untuk nama produk
        void set_name(string name) {
            this->name = name;
        }

        // Getter untuk kategori produk
        string get_category() {
            return this->category;
        }

        // Setter untuk kategori produk
        void set_category(string category) {
            this->category = category;
        }

        // Getter untuk harga produk
        double get_price() {
            return this->price;
        }

        // Setter untuk harga produk
        void set_price(double price) {
            this->price = price;
        }

        // Destruktor
        ~petshop() {
        }
};