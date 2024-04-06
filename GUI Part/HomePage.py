from customtkinter import *
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg
from matplotlib.backends.backend_tkagg import NavigationToolbar2Tk
from PIL import Image
import matplotlib.pyplot as plt
import numpy as np
import pandas as pd
import ctypes
import shutil
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
        self.logo_image = CTkImage(Image.open(current_path + "\\assets\\images\\ShoppingCart3.png"), size = (40, 40))
        self.file_image = CTkImage(Image.open(current_path + "\\assets\\images\\File.png"), size = (30, 40))
        self.model_image = CTkImage(Image.open(current_path + "\\assets\\images\\Model2.png"), size = (30, 30))
        self.graph_image = CTkImage(Image.open(current_path + "\\assets\\images\\Graph.png"), size = (30, 30))
        self.logout_image = CTkImage(Image.open(current_path + "\\assets\\images\\Logout.png"), size = (30, 35))
        self.dataset_file_path = "assets\\dataset\\sales_data.csv"
       

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
        button_font_bold = CTkFont(size = 12, weight = "bold")

        self.load_file_nav_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Load File", image = self.file_image,
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.load_file_nav_button_event)
        self.load_file_nav_button.grid(row = 1, column = 0, sticky = "ew")

        self.generate_model_nav_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Generate Model", image = self.model_image, 
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.generate_model_nav_button_event)
        self.generate_model_nav_button.grid(row = 2, column = 0, sticky = "ew")

        self.predict_sales_nav_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Predict Sales", image = self.graph_image,
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.predict_sales_nav_button_event)
        self.predict_sales_nav_button.grid(row = 3, column = 0, sticky = "ew")

        self.logout_button = CTkButton(navigation_frame, corner_radius = 0, height = 40, border_spacing = 10, text = "  Logout", image = self.logout_image,
                                    font = button_font, fg_color = "transparent", text_color = ("gray10", "gray90"), hover_color = ("gray70", "gray30"),
                                    anchor = "w", command = self.logout_button_event)
        self.logout_button.grid(row = 4, column = 0, pady = 5, sticky = "ews")

        self.load_file_frame = CTkFrame(master = self, corner_radius = 0, fg_color = "transparent")
        self.load_file_button = CTkButton(master = self.load_file_frame, text = "Load File", command = self.load_file_button_event)
        self.load_file_button.pack(pady = 10)
        self.file_description_label = CTkLabel(master = self.load_file_frame)
        self.file_description_label.pack(pady = 10)
        self.fig, self.ax = plt.subplots()
        self.canvas = FigureCanvasTkAgg(figure = self.fig, master = self.load_file_frame)
        self.toolbar = NavigationToolbar2Tk(canvas = self.canvas, window = self.load_file_frame, pack_toolbar = FALSE)
        self.toolbar.pack(pady = 10, anchor = "w", fill = "x")

        self.canvas.get_tk_widget().pack()
        plt.close(self.fig)

        self.generate_model_frame = CTkFrame(master = self, corner_radius = 0, fg_color = "transparent")
        CTkButton(master = self.generate_model_frame, text = "Generate Model").pack(pady = 10)

        self.predict_sales_frame = CTkFrame(master = self, corner_radius = 0, fg_color = "transparent")
        CTkButton(master = self.predict_sales_frame, text = "Predict Sales").pack(pady = 10)

        # select default frame
        self.select_frame_by_name("load_file")

    def select_frame_by_name(self, name):
        self.load_file_nav_button.configure(fg_color = ("gray75", "gray25") if name == "load_file" else "transparent")
        self.generate_model_nav_button.configure(fg_color = ("gray75", "gray25") if name == "generate_model" else "transparent")
        self.predict_sales_nav_button.configure(fg_color = ("gray75", "gray25") if name == "predict_sales" else "transparent")

        if name == "load_file":
            self.load_file_frame.grid(row = 0, column = 1, sticky = "nsew")
            if os.path.exists(self.dataset_file_path):
                self.file_description_label.configure(text = "Dataset already exists!")
                df = pd.read_csv(self.dataset_file_path)
                self.ax.plot(df["Month"], df["Sales"])
                self.canvas.draw()
                self.toolbar.update()

            else:
                self.file_description_label.configure(text = "Please load your dataset in Sales Predictor")

        else:
            self.load_file_frame.grid_forget()

        if name == "generate_model":
            self.generate_model_frame.grid(row = 0, column = 1, sticky = "nsew")
        else:
            self.generate_model_frame.grid_forget()

        if name == "predict_sales":
            self.predict_sales_frame.grid(row = 0, column = 1, sticky = "nsew")  
        else:
            self.predict_sales_frame.grid_forget()     

    def load_file_nav_button_event(self):
        self.select_frame_by_name("load_file")

    def load_file_button_event(self):
        filePath = filedialog.askopenfilename(title="Please select your dataset!", 
                                              filetypes=(("csv files", "*.csv"), ("txt files", "*.txt"), ("all files", "*.*")))
        shutil.copy2(filePath, self.dataset_file_path)
        self.file_description_label.configure(text = "Dataset is loaded into the system!")
        df = pd.read_csv(self.dataset_file_path)
        self.ax.plot(df["Month"], df["Sales"])
        self.canvas.draw()

    def generate_model_nav_button_event(self):
        self.select_frame_by_name("generate_model")

    def predict_sales_nav_button_event(self):
        self.select_frame_by_name("predict_sales")         

    def logout_button_event(self):
        self.destroy()

        from LoginPage import LoginPageApp
        loginPageApp = LoginPageApp(width = 600, height = 450, title = "Sales Predictor")
        loginPageApp.setCenterWindow()
        loginPageApp.setBackgroundImage()
        loginPageApp.setLoginFrame()
        loginPageApp.mainloop()


homePageApp = HomePageApp(width = 800, height = 600, title = "Sales Predictor")
homePageApp.setCenterWindow()
homePageApp.setComponents()
homePageApp.mainloop()