class PetShop:
    def __init__(self, id, name, category, price):
        self.id = id
        self.name = name
        self.category = category
        self.price = price

    def get_id(self):
        return self.id

    def get_name(self):
        return self.name

    def set_name(self, name):
        self.name = name

    def get_category(self):
        return self.category

    def set_category(self, category):
        self.category = category

    def get_price(self):
        return self.price

    def set_price(self, price):
        self.price = price
