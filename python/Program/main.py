from PetShop import PetShop # import class

def show_products(products): # list produk
    if not products:
        print("Empty Product")
        return
    
    print("+========================================================+")
    print("| NO  | ID   | Name         | Category    | Price        |")
    print("+========================================================+")
    
    for i, product in enumerate(products, start=1):
        print(f"| {i:<3} | {product.get_id():<4} | {product.get_name():<12} | {product.get_category():<11} | Rp{product.get_price():<10} |")
    
    print("+========================================================+")

def find_product(products, name): # cari produk
    for product in products:
        if product.get_name().lower() == name.lower():
            print("Found!")
            print(f"ID: {product.get_id()}\nName: {product.get_name()}\nCategory: {product.get_category()}\nPrice: Rp{product.get_price()}")
            return product
    print("Can't find the product.")
    return None

def add_product(products, last_id): # tambah produ
    name = input("Insert Name: ")
    category = input("Insert Category: ")
    price = float(input("Insert Price: "))
    new_id = last_id + 1
    products.append(PetShop(new_id, name, category, price))
    print(f"New Product Added, ID: {new_id}")
    return new_id
 
def update_product(products): # update atribut produk
    name = input("Insert Product Name: ")
    product = find_product(products, name)
    if product:
        print("Choose attribute:\n1. Name\n2. Category\n3. Price\n4. Cancel")
        choice = input("Enter choice: ")
        if choice == "1":
            product.set_name(input("Insert new Name: "))
        elif choice == "2":
            product.set_category(input("Insert new Category: "))
        elif choice == "3":
            product.set_price(float(input("Insert new Price: ")))
        elif choice == "4":
            print("Cancelled.")
        else:
            print("Unknown choice.")
        print("Product updated.")

def delete_product(products): # hapus produk berdasarkan nama
    name = input("Insert Product Name: ")
    for i, product in enumerate(products):
        if product.get_name().lower() == name.lower():
            del products[i]
            print("Product deleted.")
            return
    print("Can't find the product.")

def main():
    products = [ # contoh isi produk
        PetShop(1, "Whiskas", "Makanan", 100000),
        PetShop(2, "Rakhsa", "Pasir", 30000),
        PetShop(3, "CatHeaven", "Makanan", 200000)
    ]
    last_id = 3
    
    print("List Command:\n1. show\n2. find\n3. add\n4. update\n5. del\n6. exit")
    
    while True: # pilihan command atau aksi
        command = input("\nInsert Command: ")
        if command == "1":
            show_products(products)
        elif command == "2":
            find_product(products, input("Insert Product Name: "))
        elif command == "3":
            last_id = add_product(products, last_id)
        elif command == "4":
            update_product(products)
        elif command == "5":
            delete_product(products)
        elif command == "6":
            break
        else:
            print("Unknown Command")

if __name__ == "__main__":
    main()