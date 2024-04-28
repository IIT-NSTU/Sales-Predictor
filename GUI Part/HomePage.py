from customtkinter import *
from matplotlib.backends.backend_tkagg import FigureCanvasTkAgg
from matplotlib.backends.backend_tkagg import NavigationToolbar2Tk
from CTkMessagebox import CTkMessagebox
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
        self.model_file_path = "assets\\model\\model.pickle"
       

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
        self.load_file_button.pack(pady = (20, 0))
        self.file_description_label = CTkLabel(master = self.load_file_frame)
        self.file_description_label.pack(pady = 20)
        self.fig, self.ax = plt.subplots()
        self.canvas = FigureCanvasTkAgg(figure = self.fig, master = self.load_file_frame)
        self.canvas.get_tk_widget().pack()
        self.toolbar = NavigationToolbar2Tk(canvas = self.canvas, window = self.load_file_frame, pack_toolbar = FALSE)
        self.toolbar.pack(pady = 20, anchor = "w", fill = "x")
        plt.close(self.fig)

        self.generate_model_frame = CTkFrame(master = self, corner_radius = 0, fg_color = "transparent")
        CTkButton(master = self.generate_model_frame, text = "Generate Model", command = self.generate_model_button_event).pack(pady = (20, 0))
        self.model_description_label = CTkLabel(master = self.generate_model_frame)
        self.model_description_label.pack(pady = 20)


        self.predict_sales_frame = CTkScrollableFrame(master = self, corner_radius = 0, fg_color = "transparent")
        self.prediction_description_label = CTkLabel(master = self.predict_sales_frame)
        self.prediction_description_label.pack(pady = (20, 0))

        selection_frame = CTkFrame(master = self.predict_sales_frame, fg_color="transparent")
        selection_frame.pack(pady = 20)

        self.unit_menu = CTkOptionMenu(master = selection_frame, command=self.predict_sales_event)
        self.unit_menu.set("Select A Unit to Predict    ")
        self.unit_menu.pack(side = "left", padx = 20)

        self.predicted_sales_label = CTkLabel(master = selection_frame, text = "Predicted sales amount : ")
        self.predicted_sales_label.pack(side = "right")
        
        self.predict_fig, self.predict_ax = plt.subplots()
        self.predict_canvas = FigureCanvasTkAgg(figure = self.predict_fig, master = self.predict_sales_frame)
        self.predict_canvas.get_tk_widget().pack()
        self.predict_toolbar = NavigationToolbar2Tk(canvas = self.predict_canvas, window = self.predict_sales_frame, pack_toolbar = FALSE)
        self.predict_toolbar.pack(pady = 20, anchor = "w", fill = "x")
        plt.close(self.predict_fig)

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
                df[df.columns[0]] = pd.to_datetime(df[df.columns[0]])
                self.ax.clear()
                self.ax.plot(df[df.columns[0]], df[df.columns[1]])
                self.ax.set_xlabel(df.columns[0])
                self.ax.set_ylabel(df.columns[1])
                self.ax.set_title('Data Plot')
                self.canvas.draw()
                self.toolbar.update()

            else:
                self.file_description_label.configure(text = "Please load your dataset in Sales Predictor")

        else:
            self.load_file_frame.grid_forget()

        if name == "generate_model":
            self.generate_model_frame.grid(row = 0, column = 1, sticky = "nsew")
            if os.path.exists(self.model_file_path):
                self.model_description_label.configure(text = "Generated model already exists in your system!!!")
            else:
                self.model_description_label.configure(text = "Please generate a model for prediction.")
        else:
            self.generate_model_frame.grid_forget()

        if name == "predict_sales":
            self.predict_sales_frame.grid(row = 0, column = 1, sticky = "nsew")  
            if os.path.exists(self.model_file_path):
                self.prediction_description_label.configure(text = "Generated model already exists in your system!!!")

                import pickle
                with open(self.model_file_path, 'rb') as f:
                    loaded_model = pickle.load(f)

                from pandas.tseries.offsets import DateOffset
                df = pd.read_csv(self.dataset_file_path)
                df[df.columns[0]] = pd.to_datetime(df[df.columns[0]])
                df.set_index(df.columns[0], inplace = True)
                future_dates=[df.index[-1]+ DateOffset(months=x)for x in range(0,24)]
                future_datest_df=pd.DataFrame(index=future_dates[1:],columns=df.columns)
                self.future_df=pd.concat([df,future_datest_df])
                self.future_df['forecast'] = loaded_model.predict(start = df.size - 3, end = df.size + 24, dynamic= True)  
                self.predict_ax.clear()
                self.predict_ax.plot(self.future_df['Sales'])
                self.predict_ax.plot(self.future_df['forecast'])
                self.predict_ax.set_xlabel("Date")
                self.predict_ax.set_ylabel("Sales")
                self.predict_ax.set_title('Prediction Plot')
                self.predict_canvas.draw()
                self.predict_toolbar.update()

                future_dates_str = [date.strftime('%d / %m / %Y') for date in future_dates]
                self.unit_menu.configure(values = future_dates_str)
            else:
                self.prediction_description_label.configure(text = "Please generate a model for prediction.")
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

    def generate_model_button_event(self):
        if os.path.exists(self.dataset_file_path):
            import statsmodels.api as sm
            import pickle

            df = pd.read_csv(self.dataset_file_path)
            df[df.columns[0]] = pd.to_datetime(df[df.columns[0]])
            df.set_index(df.columns[0], inplace = True)
            sarima = sm.tsa.statespace.SARIMAX(df['Sales'],order = (1, 1, 1),seasonal_order = (1,1,1,12))
            model = sarima.fit()
            with open(self.model_file_path, 'wb') as f:
                pickle.dump(model, f)

            self.model_description_label.configure(text = "Model generated successfully.")
            CTkMessagebox(title="Success", message = "Model generated successfully!!!", icon = "check") 
        else:
            CTkMessagebox(title = "Warning", message = "Dataset not found!!!\nPlease load your dataset in Sales Predictor.", icon = "cancel") 
   

    def predict_sales_nav_button_event(self):
        self.select_frame_by_name("predict_sales")      

    def predict_sales_event(self, choice):
        from pandas.tseries.offsets import DateOffset
        df = pd.read_csv(self.dataset_file_path)
        df[df.columns[0]] = pd.to_datetime(df[df.columns[0]])
        df.set_index(df.columns[0], inplace = True)
        future_dates=[df.index[-1]+ DateOffset(months=x)for x in range(0,24)]
        future_dates_str = [date.strftime('%d / %m / %Y') for date in future_dates]
        date_index = future_dates_str.index(choice)
        self.predicted_sales_label.configure(text = "Predicted sales amount : " + str(round(self.future_df.iloc[df.size + date_index - 1].forecast, 2)))

    def logout_button_event(self):
        self.destroy()

        from LoginPage import LoginPageApp
        loginPageApp = LoginPageApp(width = 600, height = 450, title = "Sales Predictor")
        loginPageApp.setCenterWindow()
        loginPageApp.setBackgroundImage()
        loginPageApp.setLoginFrame()
        loginPageApp.mainloop()


# homePageApp = HomePageApp(width = 800, height = 600, title = "Sales Predictor")
# homePageApp.setCenterWindow()
# homePageApp.setComponents()
# homePageApp.mainloop()