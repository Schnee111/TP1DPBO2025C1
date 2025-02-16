#include <bits/stdc++.h>
#include <iomanip>  
#include "petshop.cpp"

using namespace std;

int main() {
    list<petshop> data; // Menggunakan std::list untuk menyimpan data produk
    
    // Menambahkan 5 produk awal ke dalam list
    data.push_back(petshop(1, "Whiskas", "Makanan", 100000));
    data.push_back(petshop(2, "Rakhsa", "Pasir", 30000));
    data.push_back(petshop(3, "CatHeaven", "Makanan", 200000));

    int last_id = 3;    // Menyimpan ID terakhir yang digunakan agar ID baru auto-increment
    string command;     // Variabel untuk menyimpan perintah dari pengguna

    // Menampilkan daftar command yang bisa digunakan oleh pengguna
    cout << "List Command :\n1. show\n2. find\n3. add\n4. update\n5. del\n6. exit\n";

    do {
        cout << "\nInsert Command: ";
        cin >> command; // Menerima input command dari pengguna

        if (command == "1") {  // Menampilkan daftar produk dalam bentuk tabel
            if (data.empty()) {
                cout << "Empty Product\n";
            } else {
                // Menampilkan header tabel
                cout << "+========================================================+\n";
                cout << "| NO  | ID   | Name         | Category    | Price        |\n";
                cout << "+========================================================+\n";

                int i = 1;
                for (auto it = data.begin(); it != data.end(); ++it) {
                    // Menampilkan setiap produk dengan format tabel
                    cout << "| " << left << setw(3) << i << " | " 
                        << left << setw(4) << it->get_id() << " | "
                        << left << setw(12) << it->get_name() << " | "
                        << left << setw(11) << it->get_category() << " | "
                        << "Rp" << left << setw(10) << it->get_price() << " |\n";
                    i++;
                }
                cout << "+========================================================+\n";
            }
        }
        else if (command == "2") {  // Mencari produk berdasarkan nama
            bool found = false;
            string search;

            cout << "Insert Product Name: ";
            cin >> search;

            auto it = data.begin();
            while (it != data.end() && !found) {
                if (it->get_name() == search) {
                    // Menampilkan detail produk jika ditemukan
                    cout << "Found!\n";
                    cout << "ID: " << it->get_id() << "\nNama: " << it->get_name() 
                         << "\nCategory: " << it->get_category() 
                         << "\nPrice: Rp" << it->get_price() << "\n";
                    found = true;
                } else {
                    ++it;
                }
            }

            if (!found) cout << "can't find the product.\n";
        } 
        else if (command == "3") {  // Menambah produk baru ke dalam list
            double price;
            string name, category;

            cout << "Insert Name, Category, and Price: ";
            cin >> name >> category >> price; // Input nama, kategori, dan harga produk

            int new_id = last_id++; // Auto-increment ID baru

            petshop temp(new_id, name, category, price);
            data.push_back(temp); // Menambahkan produk baru ke dalam list

            cout << "New Product Added, ID: " << new_id << "\n";
        } 
        else if (command == "4") {  // Memperbarui data produk
            bool found = false;
            string search;

            cout << "Insert Product Name : ";
            cin >> search;

            auto it = data.begin();
            while (it != data.end() && !found) {
                if (it->get_name() == search) {
                    found = true;
                    string pilihan;

                    cout << "Choose atribute:\n";
                    cout << "1. name\n2. category\n3. price\n4. cancel\n";

                    cout << "Masukan atribut: ";
                    cin >> pilihan;

                    if (pilihan == "1") {
                        string new_name;
                        cout << "Insert new Name: ";
                        cin >> new_name;
                        it->set_name(new_name);
                    } 
                    else if (pilihan == "2") {
                        string new_category;
                        cout << "Insert new Category: ";
                        cin >> new_category;
                        it->set_category(new_category);
                    } 
                    else if (pilihan == "3") {
                        double new_price;
                        cout << "Insert new Price: ";
                        cin >> new_price;
                        it->set_price(new_price);
                    } 
                    else if (pilihan == "4") {
                        cout << "cancelled.\n";
                    } 
                    else {
                        cout << "unknown.\n";
                    }

                    cout << "Product updated.\n";
                } else {
                    ++it;
                }
            }

            if (!found) cout << "can't find the product.\n";
        }
        else if (command == "5") {  // Menghapus produk berdasarkan nama
            string toDelete;
            bool found = false;

            cout << "Insert product Name: ";
            cin >> toDelete;

            auto it = data.begin();
            while (it != data.end() && !found) {
                if (it->get_name() == toDelete) {
                    it = data.erase(it); // Menghapus elemen dari list
                    found = true;
                    cout << "Product deleted.\n";
                } else {
                    it++;
                }
            }

            if (!found) cout << "can't find the product.\n";
        }
        else {
            cout << "Unknown Command\n";
        }

    } while (command != "6");  // Program terus berjalan hingga command "exit" dimasukkan

    return 0;
}
