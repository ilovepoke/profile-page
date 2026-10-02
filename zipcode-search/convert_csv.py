from pathlib import Path

# convert_csv.py があるフォルダ
base_dir = Path(__file__).parent


# =========================
# KEN_ALL.CSV
# =========================

input_file = base_dir / "KEN_ALL.CSV"
output_file = base_dir / "ken_all_utf8.csv"

# CP932として読み込む
with open(input_file, "r", encoding="cp932", newline="") as f:
    data = f.read()

# UTF-8 + LFで保存
with open(output_file, "w", encoding="utf-8", newline="\n") as f:
    f.write(data)

print("KEN_ALL.CSV の変換が完了しました。")


# =========================
# JIGYOSYO.CSV
# =========================

input_file = base_dir / "JIGYOSYO.CSV"
output_file = base_dir / "jigyosyo_utf8.csv"

# CP932として読み込む
with open(input_file, "r", encoding="cp932", newline="") as f:
    data = f.read()

# UTF-8 + LFで保存
with open(output_file, "w", encoding="utf-8", newline="\n") as f:
    f.write(data)

print("JIGYOSYO.CSV の変換が完了しました。")