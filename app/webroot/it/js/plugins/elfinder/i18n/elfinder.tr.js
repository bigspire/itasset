/**
 * Turkish translation
 * @author I.Taskinoglu & A.Kaya <alikaya@armsyazilim.com>
 * @version 2012-06-15
 */
if (elFinder && elFinder.prototype && typeof(elFinder.prototype.i18) == 'object') {
	elFinder.prototype.i18.tr = {
		translator : 'I.Taskinoglu & A.Kaya &lt;alikaya@armsyazilim.com&gt;',
		language   : 'Türkçe',
		direction  : 'ltr',
		dateFormat : 'd.m.Y H:i',
		fancyDateFormat : '$1 H:i',
		messages   : {

			/********************************** errors **********************************/
			'error'                : 'Hata',
			'errUnknown'           : 'Bilinmeyen hata.',
			'errUnknownCmd'        : 'Bilinmeyen komut.',
			'errJqui'              : 'Geçersiz Jquery configurasyonu.',
			'errNode'              : 'DOM objesine ihtiyaç duyuluyor.',
			'errURL'               : 'Geçersiz konfigurasyon, URL ayarlanmamış.',
			'errAccess'            : 'Erişim yok.',
			'errConnect'           : 'Sunucya bağlanamadı.',
			'errAbort'             : 'Bağlantı kesildi.',
			'errTimeout'           : 'Bağlantı zaman aşımına uğradı.',
			'errNotFound'          : 'Sunucu bulunamadı.',
			'errResponse'          : 'Sunucu cevabı geçersiz.',
			'errConf'              : 'Sunucu ayarları geçersiz.',
			'errJSON'              : 'PHP JSON modülü kurulmamış.',
			'errNoVolumes'         : 'Okunabilir fiziksel disk yok.',
			'errCmdParams'         : '"$1" komutu için geçersiz parametre.',
			'errDataNotJSON'       : 'Veri JSON formatında değil.',
			'errDataEmpty'         : 'Veri Boş.',
			'errCmdReq'            : 'Sunucu isteği komut gerektiriyor.',
			'errOpen'              : '"$1" açılamadı.',
			'errNotFolder'         : 'Obje Klasör değil.',
			'errNotFile'           : 'Obje Dosya değil.',
			'errRead'              : '"$1" okunamadı.',
			'errWrite'             : '"$1" Dosyasına yazılamadı.',
			'errPerm'              : 'Yetki Yok.',                        
			'errLocked'            : '"$1" dosyası kilitli olduğu için adı değiştirilemedi, taşındı veya silindi.',
			'errExists'            : '"$1" adlı dosya var zaten.',
			'errInvName'           : 'Geçersiz dosya adı.',
			'errFolderNotFound'    : 'Dizin bulunamadı.',
			'errFileNotFound'      : 'Dosya bulunamadı.',
			'errTrgFolderNotFound' : 'Hedef klasör ["$1"] bulunamadı.',
			'errPopup'             : 'İnternet gezgininiz açılır pencereleri engellememeli. Ayarlardan izin verip tekrar deneyin.',
			'errMkdir'             : '"$1" dizin oluşturulamadı.',
			'errMkfile'            : '"$1" dosya oluşturulamadı.',
			'errRename'            : '"$1" adı değiştirilemedi.',
			'errCopyFrom'          : '"$1" dizininden kopyalamaya izin verilmedi.',
			'errCopyTo'            : '"$1" dizinine kopyalamaya izin verilmedi.',
			'errUploadCommon'      : 'Dosya gönderme hatası.',
			'errUpload'            : '"$1" dosya gönderilemedi.',
			'errUploadNoFiles'     : 'Göndermek için dosya bulunamadı.',
			'errMaxSize'           : 'Data izin verilen boyuttan büyük.',
			'errFileMaxSize'       : 'Dosya izin verilen boyuttan büyük.',
			'errUploadMime'        : 'Dosya tipine izin verilmiyor.',
			'errUploadTransfer'    : '"$1" transfer hatası.', 
			'errSave'              : '"$1" kaydedilemez.',
			'errCopy'              : '"$1" kopylanamaz.',
			'errMove'              : '"$1" taşınamaz.',
			'errCopyInItself'      : '"$1" kendi içinde kopyalanamaz.',
			'errRm'                : '"$1" silinemedi.',
			'errExtract'           : '"$1" arşivi açılamadı.',
			'errArchive'           : 'Arşiv oluşturulamadı.',
			'errArcType'           : 'Desteklenmeyen Arşiv Tipi.',
			'errNoArchive'         : 'Dosya arşiv değil veya desteklenmiyor.',
			'errCmdNoSupport'      : 'Bu komut desteklenmiyor.',
			'errReplByChild'       : 'Klasör “$1” içerdiği dosyadan dolayı değiştirilemedi',
			'errArcSymlinks'       : 'Güvenlik nedeni ile arşiv açılamadı.',
			'errArcMaxSize'        : 'Arşiv dosyası izin verilen maksimum boyutun üstünde.',
			'errResize'            : 'Boyutlandırılamadı "$1".',
			'errUsupportType'      : 'Desteklenmeyen Dosya Tipi.',

			/******************************* commands names ********************************/
			'cmdarchive'   : 'Arşiv Oluştur',
			'cmdback'      : 'Geri',
			'cmdcopy'      : 'Kopyala',
			'cmdcut'       : 'Kes',
			'cmddownload'  : 'İndir',
			'cmdduplicate' : 'Dosyayı Çoğalt',
			'cmdedit'      : 'Dosyayı Düzenle',
			'cmdextract'   : 'Dosyaları Arşivden Çıkar',
			'cmdforward'   : 'İleri',
			'cmdgetfile'   : 'Dosyayı Seç',
			'cmdhelp'      : 'elFinde Hakkında',
			'cmdhome'      : 'Ana Sayfa',
			'cmdinfo'      : 'Bilgi',
			'cmdmkdir'     : 'Yeni Klasör',
			'cmdmkfile'    : 'Yeni Boş Dosya',
			'cmdopen'      : 'Aç',
			'cmdpaste'     : 'Yapıştır',
			'cmdquicklook' : 'Önizleme',
			'cmdreload'    : 'Yenile',
			'cmdrename'    : 'Adını Değiştir',
			'cmdrm'        : 'Sil',
			'cmdsearch'    : 'Dosya Ara',
			'cmdup'        : 'Üst Klasöre Git',
			'cmdupload'    : 'Dosya Gönder',
			'cmdview'      : 'Aç',
			'cmdresize'    : 'Resmi Yeniden Boyutlandır',
			'cmdsort'      : 'Sırala',

			/*********************************** buttons ***********************************/
			'btnClose'  : 'Kapat',
			'btnSave'   : 'Kaydet',
			'btnRm'     : 'Sil',
			'btnApply'  : 'Uygula',
			'btnCancel' : 'Vazgeç',
			'btnNo'     : 'Hayır',
			'btnYes'    : 'Evet',

			/******************************** notifications ********************************/
			'ntfopen'     : 'Klasör Aç',
			'ntffile'     : 'Dosya Aç',
			'ntfreload'   : 'Klasörü Yenile',
			'ntfmkdir'    : 'Klasör Oluşuturuluyor',
			'ntfmkfile'   : 'Dosya Oluşturuluyor',
			'ntfrm'       : 'Dosyaları Sil',
			'ntfcopy'     : 'Dosyaları Kopyala',
			'ntfmove'     : 'Dosyaları Taşı',
			'ntfprepare'  : 'Kopyalamak için Hazırla',
			'ntfrename'   : 'Dosyaları Adlandır',
			'ntfupload'   : 'Dosyalar Yükleniyor',
			'ntfdownload' : 'Dosyalar İndiriliyor',
			'ntfsave'     : 'Dosyalar Kaydediliyor',
			'ntfarchive'  : 'Arşiv Oluşturuluyor',
			'ntfextract'  : 'Dosyalar Arşivde Çıkarılıyor',
			'ntfsearch'   : 'Dosyalar Aranıyor',
			'ntfsmth'     : 'Birşeyler Yapılıyor >_<',
			'ntfloadimg'  : 'Resim Yükleniyor',

			/************************************ dates **********************************/
			'dateUnknown' : 'bilinmiyor',
			'Today'       : 'Bugün',
			'Yesterday'   : 'Dün',
			'Jan'         : 'Oca',
			'Feb'         : 'Şub',
			'Mar'         : 'Mar',
			'Apr'         : 'Nis',
			'May'         : 'May',
			'Jun'         : 'Haz',
			'Jul'         : 'Tem',
			'Aug'         : 'Ağu',
			'Sep'         : 'Eyl',
			'Oct'         : 'Ekm',
			'Nov'         : 'Kas',
			'Dec'         : 'Ara',
			'January'     : 'Ocak',
			'February'    : 'Şubat',
			'March'       : 'Mart',
			'April'       : 'Nisan',
			'May'         : 'Mayıs',
			'June'        : 'Haziran',
			'July'        : 'Temmuz',
			'August'      : 'Ağustos',
			'September'   : 'Eylül',
			'October'     : 'Ekim',
			'November'    : 'Kasım',
			'December'    : 'Aralık',
			'Sunday'      : 'Pazar', 
			'Monday'      : 'Pazartesi', 
			'Tuesday'     : 'Salı', 
			'Wednesday'   : 'Çarşamba', 
			'Thursday'    : 'Perşembe', 
			'Friday'      : 'Cuma', 
			'Saturday'    : 'Cumartesi',
			'Sun'         : 'Paz', 
			'Mon'         : 'Pzt', 
			'Tue'         : 'Sal', 
			'Wed'         : 'Çar', 
			'Thu'         : 'Per', 
			'Fri'         : 'Cum', 
			'Sat'         : 'Cmt',
			/******************************** sort variants ********************************/
			'sortnameDirsFirst' : 'Ada göre (önce klasörler)', 
			'sortkindDirsFirst' : 'Türe göre (önce klasörler)', 
			'sortsizeDirsFirst' : 'Boyuta göre (önce klasörler)', 
			'sortdateDirsFirst' : 'Tarihe göre (önce klasörler)', 
			'sortname'          : 'Ada göre', 
			'sortkind'          : 'Türe göre', 
			'sortsize'          : 'Boyuta göre',
			'sortdate'          : 'Tarihe göre',

			/********************************** messages **********************************/
			'confirmReq'      : 'Onay gerekli',
			'confirmRm'       : 'Dosyaları silmek istediğinize emin misiniz?<br/>Bu geri alınamaz!',
			'confirmRepl'     : 'Eski dosyaları yenileriyle değiştir?',
			'apllyAll'        : 'Tümünü uygula',
			'name'            : 'Ad',
			'size'            : 'Boyut',
			'perms'           : 'Yetkiler',
			'modify'          : 'Değiştildi',
			'kind'            : 'Tür',
			'read'            : 'oku',
			'write'           : 'yaz',
			'noaccess'        : 'yetki yok',
			'and'             : 've',
			'unknown'         : 'bilinmeyen',
			'selectall'       : 'Tüm Dosyaları Seç',
			'selectfiles'     : 'Dosyaları Seç',
			'selectffile'     : 'İlk Dosyayı Seç',
			'selectlfile'     : 'Son Dosyayı Seç',
			'viewlist'        : 'Liste görünümü',
			'viewicons'       : 'İkon görünümü',
			'places'          : 'Klasörler',
			'calc'            : 'Hesapla', 
			'path'            : 'Dizin',
			'aliasfor'        : 'Takma adı :',
			'locked'          : 'Kilitli',
			'dim'             : 'Ölçüler',
			'files'           : 'Dosyalar',
			'folders'         : 'Klasörler',
			'items'           : 'Nesneler',
			'yes'             : 'evet',
			'no'              : 'hayır',
			'link'            : 'Bağlantı',
			'searcresult'     : 'Arama Sonuçları',  
			'selected'        : 'Şeçili Nesne',
			'about'           : 'Hakkında',
			'shortcuts'       : 'Kısayollar',
			'help'            : 'Yardım',
			'webfm'           : 'Dosya Yöneticisi',
			'ver'             : 'Versiyon',
			'protocol'        : 'protocol versiyonu',
			'homepage'        : 'Proje Ana Sayfası',
			'docs'            : 'Yardım',
			'github'          : 'Fork us on Github',
			'twitter'         : 'twittwer da takip et',
			'facebook'        : 'facebookda bize katıl',
			'team'            : 'Takım',
			'chiefdev'        : 'Yapımcı',
			'developer'       : 'yapımcı',
			'contributor'     : 'katkı',
			'maintainer'      : 'geliştirici',
			'translator'      : 'çeviri',
			'icons'           : 'İkonlar',
			'dontforget'      : 'Ve... havlunuzu almayı unutmayın',
			'shortcutsof'     : 'Kısayollar Kapalı',
			'dropFiles'       : 'Dosyaları buraya sürükleyin',
			'or'              : 'veya',
			'selectForUpload' : 'Yüklenecek Dosyaları Seçin',
			'moveFiles'       : 'Dosyaları Taşı',
			'copyFiles'       : 'Dosyaları Kopyala',
			'rmFromPlaces'    : 'Klasörlerden Sil',
			'untitled folder' : 'basliksiz_klasor',
			'untitled file.txt' : 'basliksiz_dosya.txt',
			'aspectRatio'     : 'Oran',
			'scale'           : 'Ölçekle',
			'width'           : 'Genişlik',
			'height'          : 'Yükseklik',
			'mode'            : 'Mod',
			'resize'          : 'Boyutlandır',
			'crop'            : 'Kes',
			'rotate'          : 'Döndür',
			'rotate-cw'       : '90 Derece Sağa Döndür',
			'rotate-ccw'      : '90 Derece Sola Döndür',
			'degree'          : 'Açı',

			/********************************** mimetypes **********************************/
			'kindUnknown'     : 'Bilinmiyor',
			'kindFolder'      : 'Klasör',
			'kindAlias'       : 'Takma Ad',
			'kindAliasBroken' : 'Bozuk Takma Ad',
			// applications
			'kindApp'         : 'Uygulama',
			'kindPostscript'  : 'Postscript Döküman',
			'kindMsOffice'    : 'Microsoft Office Dökümanı',
			'kindMsWord'      : 'Microsoft Word Dökümanı',
			'kindMsExcel'     : 'Microsoft Excel Dökümanı',
			'kindMsPP'        : 'Microsoft Powerpoint Sunum',
			'kindOO'          : 'Open Office Dökümanı',
			'kindAppFlash'    : 'Flash Uygulaması',
			'kindPDF'         : 'Adobe Acrobat (PDF)',
			'kindTorrent'     : 'Bittorrent dosyası',
			'kind7z'          : '7z arşivi',
			'kindTAR'         : 'TAR arşivi',
			'kindGZIP'        : 'GZIP arşivi',
			'kindBZIP'        : 'BZIP arşivi',
			'kindZIP'         : 'ZIP arşivi',
			'kindRAR'         : 'RAR arşivi',
			'kindJAR'         : 'Java JAR dosyası',
			'kindTTF'         : 'True Type font',
			'kindOTF'         : 'Open Type font',
			'kindRPM'         : 'RPM paketi',
			// texts
			'kindText'        : 'Text Dökümanı',
			'kindTextPlain'   : 'Plain text',
			'kindPHP'         : 'PHP dosyası',
			'kindCSS'         : 'CSS dosyası',
			'kindHTML'        : 'HTML dosyası',
			'kindJS'          : 'Javascript dosyası',
			'kindRTF'         : 'RTF dosyası',
			'kindC'           : 'C dosyası',
			'kindCHeader'     : 'C başlık dosyası',
			'kindCPP'         : 'C++ dosyası',
			'kindCPPHeader'   : 'C++ başlık dosyası',
			'kindShell'       : 'Unix shell dosyası',
			'kindPython'      : 'Python dosyası',
			'kindJava'        : 'Java dosyası',
			'kindRuby'        : 'Ruby dosyası',
			'kindPerl'        : 'Perl dosyası',
			'kindSQL'         : 'SQL dosyası',
			'kindXML'         : 'XML dosyası',
			'kindAWK'         : 'AWK dosyası',
			'kindCSV'         : 'CSV dosyası',
			'kindDOCBOOK'     : 'Docbook XML dosyası',
			// images
			'kindImage'       : 'Resim',
			'kindBMP'         : 'BMP Resim',
			'kindJPEG'        : 'JPEG Resim',
			'kindGIF'         : 'GIF Resim',
			'kindPNG'         : 'PNG Resim',
			'kindTIFF'        : 'TIFF Resim',
			'kindTGA'         : 'TGA Resim',
			'kindPSD'         : 'Adobe Photoshop Resim',
			'kindXBITMAP'     : 'X bitmap Resim',
			'kindPXM'         : 'Pixelmator Resim',
			// media
			'kindAudio'       : 'Ses Dosyası',
			'kindAudioMPEG'   : 'MPEG ses',
			'kindAudioMPEG4'  : 'MPEG-4 ses',
			'kindAudioMIDI'   : 'MIDI ses',
			'kindAudioOGG'    : 'Ogg Vorbis ses',
			'kindAudioWAV'    : 'WAV ses',
			'AudioPlaylist'   : 'MP3 Çalma Listesi',
			'kindVideo'       : 'Video Dosyası',
			'kindVideoDV'     : 'DV video',
			'kindVideoMPEG'   : 'MPEG video',
			'kindVideoMPEG4'  : 'MPEG-4 video',
			'kindVideoAVI'    : 'AVI video',
			'kindVideoMOV'    : 'Quick Time video',
			'kindVideoWM'     : 'Windows Media video',
			'kindVideoFlash'  : 'Flash video',
			'kindVideoMKV'    : 'Matroska video',
			'kindVideoOGG'    : 'Ogg video'
		}
	}
}