from customtkinter import *
from PIL import Image
import ctypes
import os

class HomePageApp(CTk):
    width = 0
    height = 0


    def __init__(self, width, height, title):
        super().__init__()
        self.width = width
        self.height = height
        self.title(title)
        current_path = os.path.dirname(os.path.realpath(__file__))
        self.logo_image = CTkImage(Image.open(current_path + "\\images\\ShoppingCart3.png"), size = (40, 40))
        self.file_image = CTkImage(Image.open(current_path + "\\images\\File.png"), size = (30, 40))
        self.model_image = CTkImage(Image.open(current_path + "\\images\\Model2.png"), size = (30, 30))
        self.graph_image = CTkImage(Image.open(current_path + "\\images\\Graph.png"), size = (30, 30))
        self.logout_image = CTkImage(Image.open(current_path + "\\images\\Logout.png"), size = (30, 35))
       

    def setCenterWindow(self):
        scaleFactor = ctypes.windll.shcore.GetScaleFactorForDevice(0) / 100

        screen_width = self.winfo_screenwidth()
        screen_height = self.winfo_screenheight()
        x = round(((screen_width - self.width) // 2) * scaleFactor)
        y = round(((screen_height - self.height) // 2) * scaleFactor)

        self.geometry('{}x{}+{}+{}'.format(self.width, self.height, x, y))


    def setComponents(self):
        self.rowconfigure(index = 0, weight = 1)
        self.columnconfigure(index = 1, weight = 1)

        navigation_frame = CTkFrame(master = self, corner_radius = 0)
        navigation_frame.grid(row = 0, column = 0, sticky = 'ns')
        navigation_frame.rowconfigure(index = 4, weight = 1)

        navigation_frame_label = CTkLabel(navigation_frame, text = "  Sales Predictor", image = self.logo_image,
                                                        compound = "left", font = CTkFont(family = "Brush Script MT", size = 20, weight = "bold"))
        navigation_frame_label.grid(row = 0, column = 0, padx = 30, pady = 20)

        button_font = CTkFont(size = 14)

        load_file_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Load File", image = self.file_image,
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.loadFileButtonClick)
        load_file_button.grid(row = 1, column = 0, sticky = "ew")

        generate_model_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Generate Model", image = self.model_image, 
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.loadFileButtonClick)
        generate_model_button.grid(row = 2, column = 0, sticky = "ew")

        predict_sales_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Predict Sales", image = self.graph_image,
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.loadFileButtonClick)
        predict_sales_button.grid(row = 3, column = 0, sticky = "ew")

        logout_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Logout", image = self.logout_image,
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.logoutButtonClick)
        logout_button.grid(row = 4, column = 0, pady = 5, sticky = "ews")

        mainFrame = CTkFrame(master = self, fg_color="transparent", corner_radius = 0)
        mainFrame.grid(row = 0, column = 1, sticky = 'nsew')


    def loadFileButtonClick(self):
        print("Hello Buddy") 

    def logoutButtonClick(self):
        self.destroy()

        from LoginPage import LoginPageApp
        loginPageApp = LoginPageApp(width = 600, height = 450, title = "Sales Predictor")
        loginPageApp.setCenterWindow()
        loginPageApp.setBackgroundImage()
        loginPageApp.setLoginFrame()
        loginPageApp.mainloop()


homePageApp = HomePageApp(width = 800, height = 500, title = "Sales Predictor")
homePageApp.setCenterWindow()
homePageApp.setComponents()
homePageApp.mainloop()