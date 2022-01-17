<?php

namespace LaravelFirebase;

use Illuminate\Support\Collection;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Messaging\FcmOptions;
use Kreait\Firebase\Messaging\MessageData;
use Kreait\Firebase\Messaging\AndroidConfig;

/**
 *
 */
class FirebaseMessage
{
    /** @var FirebaseNotification */
    private FirebaseNotification $notification;
    
    /** @var array|Collection */
    private Collection|array $devices;
    
    /** @var null|MessageData */
    private ?MessageData $data = null;
    
    /** @var null|AndroidConfig */
    private ?AndroidConfig $androidConfig = null;
    
    /** @var null|ApnsConfig */
    private ?ApnsConfig $apnsConfig = null;
    
    /** @var null|FcmOptions */
    private ?FcmOptions $fcmOptions = null;
    
    /**
     * @return FirebaseMessage
     */
    public static function new(): FirebaseMessage
    {
        return new self();
    }
    
    /**
     * Указать опциональные данный для пуша
     *
     * @param array|MessageData $data
     *
     * @return $this
     */
    public function setData(array|MessageData $data): self
    {
        $this->data = $data instanceof MessageData ? $data : MessageData::fromArray($data);
        
        return $this;
    }
    
    /**
     * Получить опциональные данный для пуша
     *
     * @return null|MessageData
     */
    public function getData(): ?MessageData
    {
        return $this->data;
    }
    
    /**
     * Указание уведомления которое необходимо отправить
     *
     * @param FirebaseNotification $notification
     *
     * @return $this
     */
    public function setNotification(FirebaseNotification $notification): self
    {
        $this->notification = $notification;
        return $this;
    }
    
    /**
     * Получить уведомление которое необходимо отправить
     *
     * @return FirebaseNotification
     */
    public function getNotification(): FirebaseNotification
    {
        return $this->notification;
    }
    
    /**
     * Указать устройства на которые необходимо отправить данные
     *
     * @param Collection|array $devices
     *
     * @return FirebaseMessage
     */
    public function setDevices(Collection|array $devices): self
    {
        $this->devices = $devices;
        return $this;
    }
    
    /**
     * Получение списка устройств для получения уведомления
     *
     * @return array|Collection
     */
    public function getDevices(): array|Collection
    {
        return $this->devices;
    }
    
    /**
     * Установить настройки для android устройств
     *
     * @param array|AndroidConfig $config
     *
     * @return $this
     */
    public function setAndroidConfig(array|AndroidConfig $config): self
    {
        $this->androidConfig = $config instanceof AndroidConfig ? $config : AndroidConfig::fromArray($config);
        return $this;
    }
    
    /**
     * Получить настройки для android устройств
     *
     * @return null|AndroidConfig
     */
    public function getAndroidConfig(): ?AndroidConfig
    {
        return $this->androidConfig;
    }
    
    /**
     * Установить настройки для iOS устройств
     *
     * @param array|ApnsConfig $config
     *
     * @return $this
     */
    public function setApnsConfig(array|ApnsConfig $config): self
    {
        $this->apnsConfig = $config instanceof ApnsConfig ? $config : ApnsConfig::fromArray($config);
        
        return $this;
    }
    
    /**
     * Получить настройки для iOS устройств
     *
     * @return null|ApnsConfig
     */
    public function getApnsConfig(): ?ApnsConfig
    {
        return $this->apnsConfig;
    }
    
    /**
     * @param array|FcmOptions $options
     *
     * @return $this
     */
    public function setFcmOptions(array|FcmOptions $options): self
    {
        $this->fcmOptions = $options instanceof FcmOptions ? $options : FcmOptions::fromArray($options);
        
        return $this;
    }
    
    /**
     * @return null|FcmOptions
     */
    public function getFcmOptions(): ?FcmOptions
    {
        return $this->fcmOptions;
    }
    
    /**
     * @return $this
     */
    public function setDefaultSounds(): self
    {
        $this->apnsConfig = ($this->apnsConfig ? : ApnsConfig::new())->withDefaultSound();
        $this->androidConfig = ($this->androidConfig ? : AndroidConfig::new())->withDefaultSound();
        
        return $this;
    }
}
