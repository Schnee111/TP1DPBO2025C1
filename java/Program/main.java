import java.util.*;

public class main {
    public static void main(String[] args) {
        List<PetShop> data = new ArrayList<>(); // Menggunakan ArrayList untuk menyimpan data produk
        
        // Menambahkan 3 produk awal ke dalam list
        data.add(new PetShop(1, "Whiskas", "Makanan", 100000));
        data.add(new PetShop(2, "Rakhsa", "Pasir", 30000));
        data.add(new PetShop(3, "CatHeaven", "Makanan", 200000));
        
        int lastId = 3;    // Menyimpan ID terakhir yang digunakan agar ID baru auto-increment
        Scanner scanner = new Scanner(System.in);
        String command;     // Variabel untuk menyimpan perintah dari pengguna
        
        // Menampilkan daftar command yang bisa digunakan oleh pengguna
        System.out.println("List Command :\n1. show\n2. find\n3. add\n4. update\n5. del\n6. exit");
        
        do {
            System.out.print("\nInsert Command: ");
            command = scanner.next();
            
            switch (command) {
                case "1":  // Menampilkan daftar produk dalam bentuk tabel
                    if (data.isEmpty()) {
                        System.out.println("Empty Product");
                    } else {
                        System.out.println("+========================================================+");
                        System.out.println("| NO  | ID   | Name         | Category    | Price        |");
                        System.out.println("+========================================================+");

                        int i = 1;
                        for (PetShop p : data) {
                            System.out.printf("| %-3d | %-4d | %-12s | %-11s | Rp%-10.2f |\n", i++, p.getId(), p.getName(), p.getCategory(), p.getPrice());
                        }
                        System.out.println("+========================================================+");
                    }
                    break;
                
                case "2":  // Mencari produk berdasarkan nama
                    System.out.print("Insert Product Name: ");
                    String search = scanner.next();
                    
                    boolean found = false;
                    for (PetShop p : data) {
                        if (p.getName().equalsIgnoreCase(search)) {
                            System.out.println("Found!" );
                            System.out.println("ID: " + p.getId());
                            System.out.println("Nama: " + p.getName());
                            System.out.println("Category: " + p.getCategory());
                            System.out.println("Price: Rp" + p.getPrice());
                            found = true;
                            break;
                        }
                    }
                    
                    if (!found) System.out.println("Can't find the product.");
                    break;
                
                case "3":  // Menambah produk baru ke dalam list
                    System.out.print("Insert Name, Category, and Price: ");
                    String name = scanner.next();
                    String category = scanner.next();
                    double price = scanner.nextDouble();
                    
                    int newId = ++lastId; // Auto-increment ID baru
                    data.add(new PetShop(newId, name, category, price));
                    
                    System.out.println("New Product Added, ID: " + newId);
                    break;
                
                case "4":  // Memperbarui data produk
                    System.out.print("Insert Product Name: ");
                    String updateSearch = scanner.next();
                    found = false;
                    
                    for (PetShop p : data) {
                        if (p.getName().equalsIgnoreCase(updateSearch)) {
                            found = true;
                            
                            System.out.println("Choose attribute:\n1. name\n2. category\n3. price\n4. cancel");
                            System.out.print("Masukan atribut: ");
                            String pilihan = scanner.next();
                            
                            switch (pilihan) {
                                case "1":
                                    System.out.print("Insert new Name: ");
                                    p.setName(scanner.next());
                                    break;
                                case "2":
                                    System.out.print("Insert new Category: ");
                                    p.setCategory(scanner.next());
                                    break;
                                case "3":
                                    System.out.print("Insert new Price: ");
                                    p.setPrice(scanner.nextDouble());
                                    break;
                                case "4":
                                    System.out.println("Cancelled.");
                                    break;
                                default:
                                    System.out.println("Unknown.");
                                    break;
                            }
                            
                            System.out.println("Product updated.");
                            break;
                        }
                    }
                    
                    if (!found) System.out.println("Can't find the product.");
                    break;
                
                case "5":  // Menghapus produk berdasarkan nama
                    System.out.print("Insert product Name: ");
                    String toDelete = scanner.next();
                    found = false;
                    
                    Iterator<PetShop> iterator = data.iterator();
                    while (iterator.hasNext()) {
                        PetShop p = iterator.next();
                        if (p.getName().equalsIgnoreCase(toDelete)) {
                            iterator.remove();
                            found = true;
                            System.out.println("Product deleted.");
                            break;
                        }
                    }
                    
                    if (!found) System.out.println("Can't find the product.");
                    break;
                
                case "6":
                    System.out.println("Exiting...");
                    break;
                
                default:
                    System.out.println("Unknown Command");
                    break;
            }
        } while (!command.equals("6"));
        
        scanner.close();
    }
}
