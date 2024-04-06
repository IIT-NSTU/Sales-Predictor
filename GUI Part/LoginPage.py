from customtkinter import *
from CTkMessagebox import CTkMessagebox
from PIL import Image
import ctypes


class LoginPageApp(CTk):
    width = 0
    height = 0


    def __init__(self, width, height, title):
        super().__init__()
        self.width = width
        self.height = height
        self.title(title)
        self.resizable(False, False)
           

    def setCenterWindow(self):
        scaleFactor = ctypes.windll.shcore.GetScaleFactorForDevice(0) / 100

        screen_width = self.winfo_screenwidth()
        screen_height = self.winfo_screenheight()
        x = round(((screen_width - self.width) // 2) * scaleFactor)
        y = round(((screen_height - self.height) // 2) * scaleFactor)

        self.geometry('{}x{}+{}+{}'.format(self.width, self.height, x, y))


    def setBackgroundImage(self):    
        current_path = os.path.dirname(os.path.realpath(__file__))
        self.bg_image = CTkImage(Image.open(current_path + "\\assets\\images\\bg_gradient.jpg"),
                                               size = (self.width, self.height))
        self.bg_image_label = CTkLabel(self, image = self.bg_image)
        self.bg_image_label.grid(row = 0, column = 0)    


    def setLoginFrame(self):
        self.login_frame = CTkFrame(self)
        self.login_frame.grid(row = 0, column = 0, sticky = "ns")
        self.login_label = CTkLabel(self.login_frame, text = "Sales Predictor",
                                                  font = CTkFont(family = "Brush Script MT", size = 42, weight = "bold"))
        self.login_label.grid(row = 0, column = 0, padx = 30, pady = (85, 20))
        self.username_entry = CTkEntry(self.login_frame, width = 200, placeholder_text = "Username", font = CTkFont(size = 14))
        self.username_entry.grid(row = 1, column = 0, padx = 30, pady = (20, 20))
        self.password_entry = CTkEntry(self.login_frame, width = 200, show = "*", placeholder_text = "Password", font = CTkFont(size = 14))
        self.password_entry.grid(row = 2, column = 0, padx = 30, pady = (0, 20))
        self.login_button = CTkButton(self.login_frame, text = "Login", command = self.login_event, width = 200, font = CTkFont(size = 14, weight = "bold"))
        self.login_button.grid(row = 3, column = 0, padx = 30, pady = (20, 20))


    def login_event(self):
        print("Login pressed - username:", self.username_entry.get(), "password:", self.password_entry.get())
        if (self.username_entry.get() == "admin" and self.password_entry.get() == "admin") :
            self.destroy()   

            from HomePage import HomePageApp
            homePageApp = HomePageApp(width = 800, height = 500, title = "Sales Predictor")
            homePageApp.setCenterWindow()
            homePageApp.setComponents()
            homePageApp.mainloop()
        else:
            CTkMessagebox(title="Warning", message="Invalid Credentials!!!\nPlease Try Again", icon="cancel") 

    def resource_path(self, relative_path):
        try:
            # PyInstaller creates a temp folder and stores path in _MEIPASS
            base_path = sys._MEIPASS
        except Exception:
            base_path = os.path.abspath(".")

        return os.path.join(base_path, relative_path)        

    
     
